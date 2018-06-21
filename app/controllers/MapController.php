<?php


class MapController extends BaseController
{

    // Earth's radius (at the Ecuator) of 6378137 meters.
    const EARTH_RADIUS = 6378137;

    public function searchPlacesByLocation()
    {
        $data = Input::all();
        $selectedPoint = new LatLng($data['lat'], $data['lan']);
        $finalArr = [];
        $pageType = $data['pageType'];
        $catId = $data['catId'];



        if($pageType == 'advert'){
            $adverts =Advert::join('advert_cats', function($join) use($catId)
            {
                $join->on('adverts.id', '=', 'advert_cats.advert_id');
            })   ->where('adverts.gps_lan', "<>", "")
                ->where('advert_cats.cat1_id', '=', $catId)
                ->orWhere('advert_cats.cat2_id', '=', $catId)
                ->orWhere('advert_cats.cat3_id', '=', $catId)
                ->orWhere('advert_cats.cat4_id', '=', $catId)
                ->get();
            $this->enhanceResultArray($finalArr, $adverts, $selectedPoint);
        }
        else if($pageType == 'company'){
            $companies =Company::join('company_cats', function($join) use($catId)
            {
                $join->on('companies.id', '=', 'company_cats.company_id');
            })  ->where('companies.gps_lan', "<>", "")
                ->where('company_cats.cat_id', '=', $catId)
                ->get();
            $this->enhanceResultArray($finalArr, $companies, $selectedPoint);
        }else{
            $adverts = Advert::where('gps_lan', "<>", "")
                ->get();
            $companies = Company::where('gps_lan', "<>", "")
                ->get();
            $this->enhanceResultArray($finalArr, $adverts, $selectedPoint);
            $this->enhanceResultArray($finalArr, $companies, $selectedPoint);
        }

        return Response::json($finalArr);
    }

    public function getAllPlaces(){
        $data = Input::all();
        $finalArr = [];
        $pageType = $data['pageType'];
        $catId = $data['catId'];



        if($pageType == 'advert'){
           /* $adverts =Advert::join('advert_cats', function($join) use($catId)
            {
                $join->on('adverts.id', '=', 'advert_cats.advert_id');
            })   ->where('adverts.gps_lan', "<>", "")
                ->where('advert_cats.cat1_id', '=', $catId)
                ->orWhere('advert_cats.cat2_id', '=', $catId)
                ->orWhere('advert_cats.cat3_id', '=', $catId)
                ->orWhere('advert_cats.cat4_id', '=', $catId)
                ->get();*/
            $adverts_ids = AdvertCat::where('cat2_id', $catId)->lists('advert_id');
            $adverts = Advert::where('gps_lan', "<>", "")->whereIn('id', $adverts_ids)->get();
            $this->enhanceResultArray($finalArr, $adverts);
        }
        else if($pageType == 'company'){
            $companies =Company::join('company_cats', function($join) use($catId)
            {
                $join->on('companies.id', '=', 'company_cats.company_id');
            })  ->where('companies.gps_lan', "<>", "")
                ->where('company_cats.cat_id', '=', $catId)
                ->get();
            $this->enhanceResultArray($finalArr, $companies);
        }
        else{
            $adverts = Advert::where('gps_lan', "<>", "")
                ->get();
            $companies = Company::where('gps_lan', "<>", "")
                ->get();
            $this->enhanceResultArray($finalArr, $adverts);
            $this->enhanceResultArray($finalArr, $companies);
        }

        return Response::json($finalArr);
    }



    /**
     * process $item array that contains all adverts or companies items
     * enhance $finalArr with applicable items
     */

    private function enhanceResultArray(& $finalArr, $items)
    {
        foreach ($items as $item) {
            $itemLocation = new LatLng($item->gps_lat, $item->gps_lan);

                $data['item'] = $item;

            try {
                $itemView = View::make('front.map.' . strtolower(get_class($item)), $data)->render();


                $unionHtml= '';

                if(strtolower(get_class($item))=='advert'){
                    $unionHtml = '<a href="/catalog-ad/index/'.$item->relOneCat->cat2_id.'?show_id='.$item->id.'">'.$item->title.'</a>';
                }
                else{
                    $unionHtml = ' <a href="/catalog-company/index/'.$item->id.'">'.$item->title.'</a>';
                }

                $result = array(
                    'html' => $itemView,
                    'latlng' => $itemLocation,
                    'title' => $item->title,
                    'unionHtml' => $unionHtml
                );
                array_push($finalArr, $result);
            }
            catch (\Exception $e) {
//                TODO: fix model
            }
        }
    }

    /**
     * process $item array that contains adverts or companies items,
     * check whether an item located in the given radius,
     * enhance $finalArr with applicable items
     */

    private function enhanceResultArrayByRadius(& $finalArr, $items, $selectedPoint)
    {
        $radius = 5000;
        foreach ($items as $item) {
            $itemLocation = new LatLng($item->gps_lat, $item->gps_lan);
            if ($this->computeDistanceBetween($selectedPoint, $itemLocation) <= $radius) {

                $data['item'] = $item;
                    $itemView = View::make('front.map.'.strtolower(get_class($item)), $data)->render();

                $result = array(
                    'html' => $itemView,
                    'latlng' => $itemLocation,
                    'title' => $item->title
                );
                array_push($finalArr, $result);
            }
        }
    }

    /**
     * Computes the great circle distance (in radians) between two points.
     * Uses the Haversine formula.
     */
    protected function _computeDistanceInRadiansBetween($LatLng1, $LatLng2)
    {
        $p1RadLat = deg2rad($LatLng1->getLat());
        $p1RadLng = deg2rad($LatLng1->getLng());
        $p2RadLat = deg2rad($LatLng2->getLat());
        $p2RadLng = deg2rad($LatLng2->getLng());
        return 2 * asin(sqrt(pow(sin(($p1RadLat - $p2RadLat) / 2), 2) + cos($p1RadLat)
            * cos($p2RadLat) * pow(sin(($p1RadLng - $p2RadLng) / 2), 2)));
    }

    public function computeDistanceBetween($LatLng1, $LatLng2)
    {
        return self::_computeDistanceInRadiansBetween($LatLng1, $LatLng2) * self::EARTH_RADIUS;
    }
}


/**
 * class LatLng
 * Encapsulates gps_lan and gps_lat values
 */
class LatLng implements JsonSerializable
{
    protected $_lat;
    protected $_lng;

    public function __construct($lat, $lng, $noWrap = false)
    {
        $lat = (float)$lat;
        $lng = (float)$lng;

        if (is_nan($lat) || is_nan($lng)) {
            trigger_error('LatLng class -> Invalid float numbers: (' . $lat . ', ' . $lng . ')', E_USER_ERROR);
        }

        if ($noWrap === false) {
            $lat = $this->clampLatitude($lat);
            $lng = $this->wrapLongitude($lng);
        }

        $this->_lat = $lat;
        $this->_lng = $lng;
    }

    // Clamp latitude
    private function clampLatitude($lat)
    {
        return min(max($lat, -90), 90);
    }

    // Wrap longitude
    private function wrapLongitude($lng)
    {
        return $lng == 180 ? $lng : fmod((fmod(($lng - -180), 360) + 360), 360) + -180;
    }

    public function getLat()
    {
        return $this->_lat;
    }

    public function getLng()
    {
        return $this->_lng;
    }

    public function equals($LatLng)
    {
        if (!is_object($LatLng) || !($LatLng instanceof self)) {
            return false;
        }

        return abs($this->_lat - $LatLng->getLat()) <= SphericalGeometry::EQUALS_MARGIN_ERROR
        && abs($this->_lng - $LatLng->getLng()) <= SphericalGeometry::EQUALS_MARGIN_ERROR;
    }

    public function toString()
    {
        return '(' . $this->_lat . ', ' . $this->_lng . ')';
    }

    /**
     *
     * serializes object values to json in order to work with them properly on js
     */
    public function jsonSerialize()
    {
        return '{ "lat": ' . $this->_lat . ', "lng":' . $this->_lng . ' }';
    }

    public function toUrlValue($precision = 6)
    {
        $precision = (int)$precision;
        return round($this->_lat, $precision) . ',' . round($this->_lng, $precision);
    }
}
