var Chat = (function () {
  var PAGINATOR_INPUT_ID = "#paginator-input";
  var LOADER_CONTAINER = ".loader-container";
  var CHAT_CONTAINER = ".chat-container";
  var performFetch = false;
  var polingPerformed = false;

  var init = function () {
    initChatScroll();
    initPoll();
    mapEventHandlers();
  };

  var initPoll = function () {
    polingPerformed = true;

    $.post("/message/poll")
      .done(function (res) {

        if (res['messages']) {

          DCS('.scroll-pane .jspPane').append(res['messages']);

          performFetch = false;
          var scrollPane = DCS('.scroll-pane')
              .jScrollPane({ showArrows : true }).data('jsp');
          scrollPane.scrollToBottom();
          performFetch = true;
        }
        if (DCS('#dialog-search').val()=='') {
          DCS(".dialog-list .jspPane").html(res['dialogs']);
          var scrollPane = DCS('.dialogs-scroll-pane')
              .jScrollPane({ showArrows : true })
        }


      })
      .always(function () {
        setTimeout(function() {
            initPoll();
        },1000);
      })
  };

  var initChatScroll = function(){
    setTimeout(function () {
      performFetch = false;
      var scrollPane = DCS('.scroll-pane').jScrollPane({
        showArrows : true
      });
      scrollPane.data('jsp').scrollToBottom();

      var leftScroll = DCS('.dialogs-scroll-pane').jScrollPane({
        showArrows : true
      });
      leftScroll.data('jsp').scrollToElement('.dialog.active',true);
      performFetch = true;

    },0);
  };

  var mapEventHandlers = function () {
//         Send
    $(document).on("submit","form.send-form",function (e) {
      e.preventDefault();
      handleMessageSend($(this));
    });

//      send message on pressing enter
    $(document).on('keypress', '#message-content', function (e) {
      if (e.which == 13) {
        DCS('#send-btn').trigger('click');
      }
    });

//        search
    $(document).on("submit", "#search-form", function (e) {
      e.preventDefault();
    });

    $(document).on("keyup","#dialog-search", function () {
      if ($(this).val().length !== 1) {
        $.post("/message/search", $(this).serialize())
          .done(function (res) {
            DCS(".dialog-list .jspPane").html(res);
          }).always(function () {
            DCS(".dialog-list").jScrollPane({
              showArrows : true
            });
        })
      }
    });

//  attach
    $(document).on('click','.attach-plus', function () {
      DCS('.attachment').trigger('click');
    });

    $(document).on("click",".dialog-container .close", function () {

      $(document).find('.js-open-main-chat.open').removeClass('open');
      $(CHAT_CONTAINER).html('');
      $('.js_right_block_bg').remove();
      $('.main-chat-container').hide();

    });

//  change dialog
    $(document).on("click", ".dialog:not(.active)", function () {
      $(this).find('.new-message').remove();
      handleDialogChange($(this));
    });

    $(document).on('change', ".attachment", function () {
      DCS("#upload-file-name").html($(this)[0].files[0].name);
      DCS(".attach-plus").hide();
      DCS(".attach-minus").show();
    });

    $(document).on('click',".attach-minus", function () {
      hideAttachment();
    });

    $(document).on("scroll",".scroll-pane", function () {
      if (checkFetching()) {
        fetchData();
      }
    })
  };

  var handleMessageSend = function (form) {
    var attachment = DCS(".attachment")[0].files;
    var addToMessage = '';
    if (attachment.length > 0) {
      var attachmentName = attachment[0].name;
      var randId = Math.floor(Math.random() * (100 - 1) + 1);
      addToMessage = '<br><span class="attachment-link" id="m' +
          randId + '">' + attachmentName + '</span>';
      DCS("#rand-id").val(randId);
    }

    var sendForm = form[0];
    var dt = new Date();
    var time = dt.getHours() + ":" + dt.getMinutes();
    var formData = new FormData(sendForm);
    var messageContent = DCS("#message-content").val();


    if (messageContent || attachment.length > 0) {
      DCS(".scroll-pane .jspPane")
          .append('<div class="message my">' + messageContent
              + addToMessage + '<span class="time">' + time + '</span></div>');

      performFetch = false;
      var scrollPane = DCS('.scroll-pane')
          .jScrollPane({ showArrows : true }).data('jsp');
      scrollPane.scrollToBottom();
      performFetch = true;

            $.ajax({
              url: "/message/send",
              data: formData,
              type: 'POST',
              dataType:'json',
              contentType: false,
              processData: false
            })
            .done(function(res) {
                DCS('#m'+res['randId']).html('<a href="/uploads/'+
                    res['path']+'"  download="'+res['name']+'" >'+
                    res['name']+'</a>');
            });
            sendForm.reset();
            hideAttachment();
          }

        };

  var handleDialogChange = function (dialog) {
    performFetch = false;

    var thisDialog = dialog;
    var isUser = thisDialog.data("is-user");
    var dialogID = thisDialog.data("id");
    var dialogAvatar = thisDialog.find('img').attr('src');
    var dialogName = thisDialog.find('span.name').text();
    var dialogHeader = DCS('.dialog-header');
    var sendBtn = DCS('#send-btn');
    sendBtn.attr('disabled', 'disabled');
    thisDialog.removeAttr('data-is-user');

    dialogHeader.find('img').attr('src', dialogAvatar);
    dialogHeader.find('.user-dialog-name').text(dialogName);
    $(PAGINATOR_INPUT_ID).val(2);

    if (!isUser) {
      DCS("#dialog_id").val(dialogID)
    }
    DCS('#message-content').val('');


    DCS(".dialog.active").removeClass("active");
    thisDialog.addClass("active");
    $.post("/message/dialog/open",
      {
        'id' : dialogID,
        'is-user' : isUser
      }
    )
    .done(function (res) {
      if (!isUser) {

        DCS(".scroll-pane .jspPane").html(res);
        performFetch = false;
        var scrollPane = DCS('.scroll-pane')
            .jScrollPane({ showArrows : true }).data('jsp');
        scrollPane.scrollToBottom();

      } else {

        DCS("#dialog_id").val(res);
        thisDialog.data('id', parseInt(res));
        DCS(".scroll-pane .jspPane").html('');
        thisDialog.data('is-user', '');

      }
    }).always(function () {
        performFetch = true;
          sendBtn.removeAttr('disabled');
      DCS('#message-content').removeAttr('disabled');
      DCS('attach-plus').show();
      DCS('.dialog-header .user-icon img').show();
    });

  };

  var hideAttachment = function () {
    var attachmentInput = DCS(".attachment");

    DCS("#upload-file-name").html('');
    attachmentInput.replaceWith(attachmentInput.val('').clone(true));
    DCS(".attach-plus").show();
    DCS(".attach-minus").hide();

  };

  var checkFetching = function () {
    return DCS(".scroll-pane .jspPane")
            .css("top") == "0px" && performFetch;
  };

  var fetchData = function () {
    var loader = $(LOADER_CONTAINER);
    loader.show();
    performFetch = false;
    $.get("/message/messages?page=" + $(PAGINATOR_INPUT_ID).val()
        + "&id=" + DCS("#dialog_id").val())
      .done(function (res) {
        if (res) {
          performFetch = true;
          $(PAGINATOR_INPUT_ID).val($(PAGINATOR_INPUT_ID).val()+1);
        }
        DCS(".scroll-pane .jspPane").prepend(res);
        var scrollPane = DCS('.scroll-pane')
            .jScrollPane({ showArrows : true }).data('jsp');
        scrollPane.scrollTo(0, 2);

      }).always(function () {
        loader.hide();
      })
  };

  // dynamic content selector
  var DCS = function (selector) {
    return $(CHAT_CONTAINER).find(selector);
  };

  return{
    init : init,
    open : initChatScroll
  }
})();




