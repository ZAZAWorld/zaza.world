@extends('admin.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Set date</h3>
    </div>
    {{ Form::open(array('url'=>action('AdminStatController@getIndex'), 'method' => 'GET', 'role'=>'form')) }}
        <div class="box-body">
            <div class="form-group">
                <label for="begin">Begin date</label>
				<input class="form-control normalValidate" id="begin" required="required" name="begin" type="date" value="{{ $begin }}" >
            </div>
            <div class="form-group">
                <label for="end">End date</label>
                <input class="form-control normalValidate" id="end" required="required" name="end" type="date" value="{{ $end }}" >
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {{ Form::close() }}
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
							<th>#</th>
                            <th>Наименование </th>
                            <th>Личные аккаунты</th>
                            <th>Коммерческиe Платныe</th>
                            <th>Коммерческиe Бесплатныe</th>
							<th>Рестораны </th>
							<th>Итого</th>
                        </tr>
						<tr>
							<td>1</td>
							<td>Количество посетителей </td>
							<td>{{ (isset($stat_onlain['person']) ? $stat_onlain['person']: 0) }}</td>
							<td>{{ (isset($stat_onlain['vip_company']) ? $stat_onlain['vip_company']: 0) }}</td>
							<td>{{ (isset($stat_onlain['simple_company']) ? $stat_onlain['simple_company']: 0) }}</td>
							<td>{{ (isset($stat_onlain['restoran']) ? $stat_onlain['restoran']: 0) }}</td>
							<td>{{ ((isset($stat_onlain['person']) ? $stat_onlain['person']: 0) 
									+ (isset($stat_onlain['vip_company']) ? $stat_onlain['vip_company']: 0) 
									+ (isset($stat_onlain['simple_company']) ? $stat_onlain['simple_company']: 0)
									+ (isset($stat_onlain['restoran']) ? $stat_onlain['restoran']: 0)) }}</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Регистрация аккаунтов</td>
							<td>{{ (isset($stat_user_created['person']) ? $stat_user_created['person']: 0) }}</td>
							<td>{{ (isset($stat_user_created['vip_company']) ? $stat_user_created['vip_company']: 0) }}</td>
							<td>{{ (isset($stat_user_created['simple_company']) ? $stat_user_created['simple_company']: 0) }}</td>
							<td>{{ (isset($stat_user_created['restoran']) ? $stat_user_created['restoran']: 0) }}</td>
							<td>{{ ((isset($stat_user_created['person']) ? $stat_user_created['person']: 0) 
									+ (isset($stat_user_created['vip_company']) ? $stat_user_created['vip_company']: 0) 
									+ (isset($stat_user_created['simple_company']) ? $stat_user_created['simple_company']: 0)
									+ (isset($stat_user_created['restoran']) ? $stat_user_created['restoran']: 0)) }}</td>
						</tr>
						<tr>
							<td rowspan='6' style='vertical-align: middle; text-align:center'>3</td>
							<td><b>Подано объявлении всего:</b></td>
							<td>{{ (isset($stat_adv_created['person']) ? $stat_adv_created['person']: 0) }}</td>
							<td>{{ (isset($stat_adv_created['vip_company']) ? $stat_adv_created['vip_company']: 0) }}</td>
							<td>{{ (isset($stat_adv_created['simple_company']) ? $stat_adv_created['simple_company']: 0) }}</td>
							<td>{{ (isset($stat_adv_created['restoran']) ? $stat_adv_created['restoran']: 0) }}</td>
							<td>{{ ((isset($stat_adv_created['person']) ? $stat_adv_created['person']: 0) 
									+ (isset($stat_adv_created['vip_company']) ? $stat_adv_created['vip_company']: 0) 
									+ (isset($stat_adv_created['simple_company']) ? $stat_adv_created['simple_company']: 0)
									+ (isset($stat_adv_created['restoran']) ? $stat_adv_created['restoran']: 0)) }}</td>
						</tr>	
						<tr>
							<td colspan='6' style='vertical-align: middle; text-align:center'>из них:</td>
						</tr>
						<tr>
							<td>TOP (в количестве)</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</td>
						<tr>
							<td>TOP (в сумме)</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</td>
						<tr>
							<td>Др. платные функции  (в количестве)</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</td>
						<tr>
							<td>Др.платные функции (в сумме)</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</td>
						<tr>
							<td>4</td>
							<td>Объявления Отклоненные модератором (колич)</td>
							<td>{{ (isset($stat_adv_canceled['person']) ? $stat_adv_canceled['person']: 0) }}</td>
							<td>{{ (isset($stat_adv_canceled['vip_company']) ? $stat_adv_canceled['vip_company']: 0) }}</td>
							<td>{{ (isset($stat_adv_canceled['simple_company']) ? $stat_adv_canceled['simple_company']: 0) }}</td>
							<td>{{ (isset($stat_adv_canceled['restoran']) ? $stat_adv_canceled['restoran']: 0) }}</td>
							<td>{{ ((isset($stat_adv_canceled['person']) ? $stat_adv_canceled['person']: 0) 
									+ (isset($stat_adv_canceled['vip_company']) ? $stat_adv_canceled['vip_company']: 0) 
									+ (isset($stat_adv_canceled['simple_company']) ? $stat_adv_canceled['simple_company']: 0)
									+ (isset($stat_adv_canceled['restoran']) ? $stat_adv_canceled['restoran']: 0)) }}</td>
						</tr>
						<tr>
							<td rowspan='3' style='vertical-align: middle; text-align:center'>5</td>
							<td>Аккаунты выведенные в ТОР (количество)</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</td>
						<tr>
							<td>Аккаунты выведенные в ТОР (сумма)</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</td>
						<tr>
							<td>Banner Advertising</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
