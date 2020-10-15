var __LOCAL = function( str ){ return str };
$.sound_path = "<?= layout() ?>sounds/";
$.throttle_delay = 150;
$.menu_speed = 150;
$.navbar_height = 49;
$.root_ = $('body');
$.left_panel = $('#left-panel');
$.device = null;
$.enableJarvisWidgets = true;
$.enableMobileWidgets = false;
var ismobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
if (!ismobile) {
  $.root_.addClass("desktop-detected");
  $.device = "desktop";
} else {
  $.root_.addClass("mobile-detected");
  $.device = "mobile";
}
$.ajaxSetup({
  cache: true
});
var App = {

  userData: false,
  GlobalRefresh: function(){
    window.location.href = '<?= base_url() ?>';
  },
  
  StoreSessionAdmin: function(){
    if (typeof localStorage == 'undefined') return false;
    if ( ! App.userData) return localStorage.removeItem('AdminSession');
    localStorage.setItem('AdminSession', Math.round((new Date()).valueOf() / 1000) + 60 * 60);
  },
  
  Log: function(title, text, nodate){
    var date = nodate ? '' : (new Date()).format('hh:mm:ss')
    	, style = "font-weight: bold; color: blue; font-size: 14px;"
  	;

    if (text)
    {
    	return console.log("%c" + title, style, text, date);
  	}

    if ( ! $.isPlainObject(title) && ! $.isArray(title) && ! $.isFunction(title))
    {
      return console.log("%c" + title, style, date);
    }

    console.log("%cData Element", style, date);
    return console.log(title);
  },
  Title: {
    force: function(){
      App.Title.pos = 0;
      App.Title.refresh();
    },
    refresh: function(){
      App.Title.count = $('#widget-chat-container .widget-chat-box.new-messages').length;
      if(App.Title.pos == 0)
        document.title = (App.Title.count ? "(" + App.Title.count + ") " : ((App.Notifications.count ? "(" + App.Notifications.count + ") " : "") )) + App.Title.title;
      else if( App.Title.pos == 2 && App.Title.alt)
        document.title = App.Title.alt;
      App.Title.pos++;
      if( App.Title.pos == 4 ) App.Title.pos = 0;
    },
    activate: function(){
      clearInterval(App.Title.interval);
      App.Title.interval = setInterval(App.Title.refresh, 1000);
    },
    set: function(element, value){
      if(element == 'title')
        App.Title.title = value;
      if(element == 'alt')
        App.Title.alt = value;
      if(element == 'count')
        App.Title.count = value;
      App.Title.force();
    },
    interval: false,
    title: '',
    alt: false,
    count: 0,
    pos: 0
  },

  Notifications: {

    URL : '<?= base_url() ?>manager/notifications/',
    count: 0,

    flush: function(){
      $('#widget-notifications .widget-content .widget-content-inside').html('');
    },

    render: function(){
      $('#widget-notifications .widget-content').scrollTop(0);
      $('#widget-notifications .widget-content .widget-item .widget-item-actions .item-action').tooltip({
        title: function(){
          return $(this).attr('data-title') ? $(this).attr('data-title') : $(this).attr('title');
        },
        trigger: 'hover',
        container: 'body',
        template: '<div class="tooltip tooltip-nz tooltip-nz-notification-count" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        placement: 'left'
      });
      $('#widget-notifications .widget-content .widget-item:not(.item-render)').each(function(index, item){
        item = $(item);
        $('.widget-item-link-blank', item).click(function(){
          if(item.hasClass('not-viewed')) $('.action-read', item).click();
        });
        $('.widget-item-link-loader', item).click(function(e){
          if(item.hasClass('not-viewed')) $('.action-read', item).click();
          if(e && (e.which == 2 || e.ctrlKey))
          {
            e.stopPropagation();
            return;
          }
          App.loadURL($(this).attr('href'), true);
          e.preventDefault();
          return false;
        });
        $('.action-read', item).click(function(){
          item.removeClass('not-viewed');
          $.ajax({
            url: App.Notifications.URL + 'read',
            cache: false,
            type: "POST",
            data: { id: item.attr('data-id') },
            dataType: "json"
          }).done(function(json){
            App.Notifications.count = json.notifications.count;
            App.Notifications.update();
          });
        });
        $('.action-unread', item).click(function(){
          item.addClass('not-viewed');
          $.ajax({
            url: App.Notifications.URL + 'unread',
            cache: false,
            type: "POST",
            data: { id: item.attr('data-id') },
            dataType: "json"
          }).done(function(json){
            App.Notifications.count = json.notifications.count;
            App.Notifications.update();
          });
        });
        $('.action-delete', item).click(function(){
          $.SmartMessageBox({
            title : "<?= $this->lang->line("¿Está seguro que desea eliminar definitivamente la notificación?") ?> <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span>",
            buttons : '[<?= $this->lang->line("No") ?>][<?= $this->lang->line("Si") ?>]'
          }, function(ButtonPressed) {
            if (ButtonPressed == "<?= $this->lang->line("Si") ?>") {
              $.ajax({
                url: App.Notifications.URL + 'delete',
                cache: false,
                type: "POST",
                data: { id: item.attr('data-id') },
                dataType: "json"
              }).done(function(json){
                App.Notifications.count = json.notifications.count;
                App.Notifications.update();
              });
              item.remove();
            }
          });
          $("#MsgBoxBack").click(function(e){
            e.stopPropagation();
          });
          $("#MsgBoxBack .MessageBoxMiddle").addClass('MessageBoxMiddleLogout');
          $($("#MsgBoxBack .MessageBoxButtonSection button")[1]).addClass('btn-danger');
        });
      });
      $('#widget-notifications .widget-content .widget-item').addClass('item-render');
    },

    list: function(){
      var position = 0;
      $('#widget-notifications .widget-content .widget-item').remove();
      if($('#widget-notifications .widget-content .widget-item').length)
        position = $('#widget-notifications .widget-content .widget-item').first().attr('data-id');
      Pace.ignore(function(){
        $.ajax({
          url: App.Notifications.URL + 'list',
          cache: false,
          type: "POST",
          data: { position: position },
          dataType: "html"
        }).done(function(html) {
          $('#widget-notifications .widget-content .widget-no-notifications').remove();
          $('#widget-notifications .widget-content .widget-content-inside').prepend(html);
          App.Notifications.render();
          $('#widget-notifications').removeClass('widget-loading');
        }).fail(function() {
          $('#widget-notifications').removeClass('widget-loading');
        });
      });
    },

    prepare: function(){
      $('#widget-notifications .widget-content').on('scroll', function(e)  {
        var delta = e.originalEvent.wheelDelta || -e.originalEvent.detail;
        if (delta > 0 && $(this).scrollTop() <= 0)
            return false;
        if (delta < 0 && $(this).scrollTop() >= this.scrollHeight - $(this).height())
            return false;
        return true;
      });
      $('#widget-notifications .widget-count-box').tooltip({
        title: function(){
          return $(this).attr('data-title') ? $(this).attr('data-title') : $(this).attr('title');
        },
        trigger: 'hover',
        container: 'body',
        template: '<div class="tooltip tooltip-nz tooltip-nz-notification-count" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        placement: 'left'
      }).click(function(){
        App.Notifications.count = 0;
        App.Notifications.update();
        $('#widget-notifications .widget-content .widget-item').removeClass('not-viewed');
        Pace.ignore(function(){
          $.ajax({
            cache: false,
            url: App.Notifications.URL + 'readall',
            dataType: "json",
            processData: false
          });
        });
      });
    },

    update: function(){
    	$('#header .action-notifications .notifications-count').text(App.Notifications.count);
    	$('#widget-notifications .widget-header .widget-count').text(App.Notifications.count);
      $('#header .action-notifications').toggleClass('with-notifications', App.Notifications.count > 0);
      $('#widget-notifications').toggleClass('with-notifications', App.Notifications.count > 0);
      App.Title.force();
    },

    refresh: function(){
      if($('#widget-notifications').hasClass('widget-loading')) return;
      $('#widget-notifications').addClass('widget-loading');
      App.Notifications.list();
    },

    parse: function(count){
      App.Notifications.count = count;
      App.Notifications.update();
    }

  },

  Chat: {

    URL: false,
    disabled: false,
    focus: true,
    state: 0,
    pullTimeout: false,
    minPullTime: 2000,
    pullTime: 2000,
    pictures: [],

    pull: function(){
      if(!App.Chat.URL || App.Chat.disabled) return false;
      if(App.Chat.focus)
        App.Chat.pullTime = App.Chat.minPullTime;
      else
        App.Chat.pullTime += App.Chat.minPullTime;
      clearTimeout(App.Chat.pullTimeout);
      App.Chat.pullTimeout = setTimeout(App.Chat.pull, App.Chat.pullTime);
      Pace.ignore(function(){
        $.ajax({
          cache: false,
          url: App.Chat.URL + 'pull',
          dataType: "json",
          processData: false
        }).fail(function(json) {
          App.GlobalRefresh();
        }).done(function(json) {
          if(!json)
            return App.GlobalRefresh();
          App.Notifications.parse(json.notifications);
          if(!json.messages) return;
          var ids = [];
          $.each(json.messages, function(index, message){
            if($.inArray(message.id, ids) > -1) return;
            var ret = App.Chat.addMessage({
              id: message.id,
              type: message.type,
              viewed: message.viewed,
              user: 0,
              message: message.message,
              time: parseInt(message.time)
            }, message.id, true);
            if(!ret)
              return ids.push(message.id);
          });
        });
      });
    },

    tooltip: function() {
      return {
        selector: '.tooltip-chat.tooltip-active',
        trigger: 'hover',
        title: function(){
          return $(this).attr('data-title');
        },
        container: 'body',
        template: '<div class="tooltip tooltip-close-chat" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        placement: 'top'
      };
    },

    Contacts: {


      count: 0,
      time: 10000,
      box: false,
      timeout: false,


      closeRefresh: function() {
        var template = '<div class="tooltip tooltip-close-chat" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>';
        $('#widget-chat .widget-chat-search .widget-chat-close').tooltip('destroy').tooltip({
          title: App.Chat.disabled ? '<?= $this->lang->line('Activar chat') ?>' : '<?= $this->lang->line('Desactivar chat') ?>',
          container: 'body',
          template: template,
          placement: 'left'
        });
      },

      createBox: function(){

        App.Chat.URL = "<?= base_url() ?>manager/chat/";

        var chatBox = App.Chat.Contacts.box = $('<div id="widget-chat" class="widget-chat"><div class="widget-chat-contacts"><div class="widget-chat-contacts-inside"></div></div><div class="widget-chat-search"><div class="widget-chat-close"><i class="fa fa-power-off"></i></div><i class="ico-search fa fa-search"></i><div class="input-search"><input placeholder="<?= $this->lang->line("Buscar") ?>" /></div></div></div>').appendTo( $('body') );

        if(App.Chat.disabled)
          chatBox.addClass('chat-disabled');

        $(window).scroll(function(){
          var top = $('#header').outerHeight() - $(window).scrollTop();
          if(top < 0) top = 0;
          $('.widget-chat-contacts', chatBox).css('top', top);
        });

        $('.widget-chat-contacts', chatBox).bind('mousewheel DOMMouseScroll', function( e ){
          e.stopPropagation();
          var sy = $('.widget-chat-contacts', chatBox).scrollTop();
          if( (sy <= 0 && e.originalEvent.deltaY<0) || (sy >= $('.widget-chat-contacts .widget-chat-contacts-inside', chatBox).height() && e.originalEvent.deltaY>0))
            return false;
        });

        App.Chat.Contacts.closeRefresh();

        $('.widget-chat-close', chatBox).click(function(){
          chatBox.toggleClass('chat-disabled');
          App.Chat.disabled = chatBox.hasClass("chat-disabled");
          App.Chat.Contacts.closeRefresh();
          $(this).tooltip('show');
          Pace.ignore(function(){
            $.ajax({
              url: '<?= base_url() ?>app/sessiong',
              type: "POST",
              data: {
                'item': 'chat-disabled',
                'value': App.Chat.disabled ? "1" : "0"
              },
              dataType: "json"
            });
          });
        });

        $('.widget-chat-search input', chatBox).blur(function(){
          $(this).val('');
          $('.widget-chat-contacts .chat-company .company-title', chatBox).removeClass('hide');
          $('.widget-chat-contacts .chat-item', chatBox).removeClass('hide');
        }).keyup(function(){
          var search = $(this).val().toLowerCase();
          $.each($('.widget-chat-contacts .chat-item', chatBox), function(index, el){
            el = $(el);
            el.addClass('hide');
            data = el.data();
            var ret = false;
            if(data.lastname.toLowerCase().indexOf(search) >= 0 || data.name.toLowerCase().indexOf(search) >= 0 || data.company.toLowerCase().indexOf(search) >= 0)
              el.removeClass('hide');
          });
          $('.widget-chat-contacts .chat-company .company-title', chatBox).addClass('hide');
        });

        $([window, document]).blur(function(){
          App.Chat.focus = false;
        }).focus(function(){
          if(!App.Chat.focus) App.Chat.pull();
          App.Chat.focus = true;
        }).scroll();

        App.Chat.pull();

      },

      addCompany: function(el){
        var contacts = $('.widget-chat-contacts .widget-chat-contacts-inside', App.Chat.Contacts.box);
        if($('.chat-company.chat-company-' + el.idcompany, contacts).length) return;
        var company = $('<div class="chat-company chat-company-'+el.idcompany+'"><div class="company-title">'+el.company+'<span class="count"></span></div></div>');
        $('.company-title', company).click(function(){
          $('.widget-chat-contacts', App.Chat.Contacts.box).animate({
            scrollTop: $(this).parents('.chat-company').position().top + parseInt($('.widget-chat-contacts', App.Chat.Contacts.box).scrollTop()) - 4
          });
        });
        contacts.append(company);
      },

      createUser: function(el){
        var contacts = $('.widget-chat-contacts .widget-chat-contacts-inside', App.Chat.Contacts.box);
        var picture = false;
        if(el.picture)
        {
          picture = '<img src="'+el.picture+'" />';
        }
        $('.chat-company.chat-company-' + el.idcompany, contacts).append(
          $('<div class="chat-item chat-item-' + el.id + '"><div class="chat-item-image' + (picture ? '' : ' no-picture') + '">' + (picture ? picture : '<img/>') + '</div><div class="chat-item-name">' + el.name + (el.lastname ? ' ' + el.lastname : '') + '</div><div class="chat-item-status status-'+ el.status+'"><div class="status-point"></div><div class="status-connection">'+ App.Chat.getLastConnection(el.connection) +'</div></div></div>').data(el).click(function(){
            App.Chat.open(el);
          })
        );
      },

      updateUser: function(el, item){
        if($('.chat-item-image img', item).attr('src') != el.picture)
          $('.chat-item-image img', item).attr('src', el.picture);
        $('.chat-item-status', item).removeClass('status-0 status-1 status-2').addClass('status-' + el.status);
        $('.chat-item-name', item).text(el.name + (el.lastname ? ' ' + el.lastname : ''));
        $('.status-connection', item).text(App.Chat.getLastConnection(el.connection));
        var box = App.Chat.getUserBox(el.id);
        if(box)
        {
          $('.box-status', box).removeClass('status-0 status-1 status-2').addClass('status-' + el.status);
          $('.box-status .status-connection', box).text(App.Chat.getLastConnection(el.connection));
          $('.box-user-name', box).text(el.name);
        }
      },

      addUser: function(el){
        App.Chat.Contacts.addCompany(el);
        var item = $('.widget-chat-contacts .widget-chat-contacts-inside .chat-item.chat-item-' + el.id, App.Chat.Contacts.box);
        if(item.length)
          App.Chat.Contacts.updateUser(el, item);
        else
          App.Chat.Contacts.createUser(el);
      },

      refreshCompanyCount: function(){
        $.each($('.chat-company', App.Chat.Contacts.box), function(index,el){
          el = $(el);
          if(!$('.chat-item', el).length)
            el.remove();
          if($('.chat-item', el).length>1)
            $('.count',el).text('(' + $('.chat-item', el).length + ')');
        });
      },

      parse: function(json){
        $.each(json, function(index, el){
          App.Chat.Contacts.addUser(el);
        });
        App.Chat.Contacts.refreshCompanyCount();
        if(!App.Chat.state)
        {
          if(!App.Chat.disabled && App.userData)
          {
            $.each(App.userData.recentChat.split(','), function(p, id){
              $.each(json, function(index, el){
                if( el.id == parseInt(id) )
                {
                  if(el.opened == 2)
                    App.Chat.open(el, 1);
                  else if(el.opened == 1)
                    App.Chat.open(el, 2, el.size);
                  else
                    App.Chat.open(el, 2);
                }
              });
            });
          }
        }
        App.Chat.state = 1;
      },

      refresh: function(){
        if($('body').hasClass("mobile-detected") || !$('body').hasClass("chat-active") ) return false;
        App.Chat.Contacts.box = $('#widget-chat');
        if(!App.Chat.Contacts.box.length) App.Chat.Contacts.createBox();
        if(!App.Chat.URL) return false;
        clearTimeout(App.Chat.Contacts.timeout);
        if(!App.Chat.focus)
          App.Chat.Contacts.timeout = setTimeout(App.Chat.contacts, App.Chat.Contacts.time * 3);
        else
          App.Chat.Contacts.timeout = setTimeout(App.Chat.contacts, App.Chat.Contacts.time);
        /*if(!App.Chat.focus && App.Chat.Contacts.count < 10) return App.Chat.Contacts.count++;
        App.Chat.Contacts.count = 0;*/
        Pace.ignore(function(){
          $.ajax({
            cache: false,
            url: App.Chat.URL + 'contacts',
            dataType: "json",
            processData: false
          }).done(function(json) {
            App.Notifications.parse(json.notifications);
            App.Chat.Contacts.parse(json.contacts);
          });
        });
      }

    },

    adjustedHeight: function(textarea, min) {
      var adjustedHeight = textarea[0].scrollHeight, textareap = textarea.parent();
      if(min) adjustedHeight = 28;
      var maxHeight = parseInt(textareap.css('max-height'));
      textarea.css('height', adjustedHeight);
      if(maxHeight > adjustedHeight) {
        textareap.css('overflow-y','hidden');
      }else{
        textareap.css('overflow-y','auto');
      }
      textareap.css('height', adjustedHeight);
    },

    clearMessage: function (message) {
      message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");
      var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;
      message = message.replace(exp,"<a target='_blank' href='$1'>$1</a>");
      message = message.replace(/\n/g,"<br/>");
      message = message.replace("<br/> ","<br/>");
      return message;
    },

    errorWrite: function (user, idm) {
      var box = App.Chat.getUserBox(user.id);
      $('.box-content .user-message-'+ user.id + ' .item-' + idm, box).addClass('message-error');
      App.Chat.scrollBottomId(user.id);
    },

    addMessages: function (user, messages) {
      if(!messages) return;
      $.each(messages, function(index, message){
        App.Chat.addMessage(message, user);
      });
      App.Chat.scrollBottomId(user);
    },

    getLastConnection: function(time) {
      if(!time) return "";
      var t = new Date();
      var dif = 0;
      t = parseInt(t.getTime() / 1000);
      dif = Math.ceil((t - time)/60);
      if(dif < 0)
        return '';
      if(dif < 60) return '<?= $this->lang->line('$1 m') ?>'.replace('$1', dif);
      dif = Math.ceil(dif/60);
      if(dif < 24) return '<?= $this->lang->line('$1 h') ?>'.replace('$1', dif);
      dif = Math.ceil(dif/24);
      if(dif < 100) return '<?= $this->lang->line('$1 d') ?>'.replace('$1', dif);
      return '';
    },

    getHourMessage: function(time) {
      var dd = new Date(), d2 = new Date();
      dd.setTime(parseInt(time*1000));
      if(dd.format('dd/MM/yyyy') == d2.format('dd/MM/yyyy'))
        return dd.format('hh:mm');
      return dd.format('dd/MM/yyyy hh:mm')
    },

    generateFile: function (data) {
      if(!data) return '';
      json = JSON.parse(data);
      return '<div class="widget-filemanager"><a class="file-box link" href="'+ json.url +'" target="_blank"><div data-type="'+ json.type +'" class="file-info type-'+ json.type +'"><div class="file-ico">'+ (
      (parseInt(json.type) == 1 ) ? '<img src="<?= base_url() ?>app/thumbc/'+json.id+'" />' : '' )+'</div></div><span class="file-name">'+ json.name +'</span></a></div>'
    },

    addMessage: function (data, user, append) {
      var box = App.Chat.getUserBox(user);
      if(!box)
      {
        if(!App.Chat.disabled) App.Chat.createBoxById(user);
        return false;
      }
      data.type = data.type ? parseInt(data.type) : 1;
      if(data.type == 2)
      {
        message = App.Chat.generateFile(data.message);
      }
      else
      {
        message = App.Chat.clearMessage(data.message);
      }
      data.viewed = data.viewed ? parseInt(data.viewed) : 0;
      data.user = parseInt(data.user);
      var template = '<div class="tooltip box-tooltip-hour" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>';
      if(message)
      {
        var idm = parseInt(parseInt(data.time)/10);
        var hour = App.Chat.getHourMessage(data.time);
        var gms = $('.box-content .box-content-inside .user-message-' + data.id + '.time-message-' + idm, box), gm = gms.length ? $(gms[gms.length-1]) : false;
        var cmsg = $('.box-content .box-content-inside .content-message', box), last = cmsg.length ? $(cmsg[cmsg.length-1]) : false
        if(append && gm && last)
        {
          if(!last.hasClass('user-message-' + data.id)) gm = false;
        }
        if(gm)
        {
          if(append)
            $('.content-message-text', gm).append('<div class="content-message-text-item item-' + idm + '">'+ message + '</div>');
          else
            $('.content-message-text', gm).prepend('<div class="content-message-text-item item-' + idm + '">'+ message + '</div>');
        }
        else
        {
          var ms = $('<div data-time="' + idm + '" class="content-message' + (data.user ? ' user-message' : '') + ' time-message-' + idm + ' user-message-'+ data.id +'"><div class="content-message-balloon"><div class="ico-global content-message-arrow"></div><div class="content-message-text"><div class="content-message-text-item item-' + idm + '">'+ message + '</div></div></div></div>');
          if(append)
            $('.box-content .box-content-inside', box).append(ms);
          else
            $('.box-content .box-content-inside', box).prepend(ms);
          if(!data.user)
          {
            $('#widget-chat .widget-chat-contacts .chat-item.chat-item-' + data.id + ' .chat-item-image').clone().removeClass('chat-item-image').addClass('content-message-image').prependTo(ms).attr('title', hour).tooltip({
              container: 'body',
              trigger: 'hover',
              template: template,
              placement: 'left'
            });
          }
          else
          {
            $('.user-message .content-message-text .content-message-text-item.item-' + idm, gm).attr('title', hour).tooltip({
              container: 'body',
              trigger: 'hover',
              template: template,
              placement: 'right'
            });
          }
        }
      }

      if(message && !data.user && !data.viewed)
      {
        var userD = box.data('user');
        App.Title.set('alt', '<?= $this->lang->line('$1 te envió un mensaje') ?>'.replace('$1', userD.name));
        App.Chat.highlightBox(data.id);
        App.Chat.refreshMore();
      }
      if(append)
      {
        App.Chat.scrollBottomId(data.id);
      }
      $('.widget-filemanager img', box).load(function() {
        setTimeout(function () {
          App.Chat.scrollBottom(box);
        }, 100);
      }).error(function(){
        var parent = $(this).parent();
        $(this).remove();
        parent.parent().removeClass('type-1').addClass('type-error').attr('data-type', '0');
      })
      return true;
    },

    write: function (message, user, idm) {
      if(message)
      {
        App.Chat.addMessage({
          id: App.userData.id,
          user: 1,
          message: message,
          time: parseInt(new Date().getTime()) / 1000
        }, user.id, true);
      }
      App.Chat.scrollBottomId(user.id);
    },

    highlightBox: function(id) {
      var nm = $('.box-head .box-title .box-new-messages', $('#widget-chat-user-' + id).addClass('new-messages'));
      nm.text(parseInt(nm.text()) + 1);
    },

    scrollBottom: function(box) {
      if(!box) return;
      var top = $('.box-content .box-content-inside', box).height();
      if(!top) top = 0;
      if( top < $('.box-content', box).height() )
        top = $('.box-content', box).height();
      if(!top) return;
      $('.box-content', box).scrollTop(top);
    },

    scrollBottomId: function(id) {
      var box = $('#widget-chat-user-' + id);
      if(!box) return;
      App.Chat.scrollBottom(box);
    },

    createBoxById: function (user) {
      if(!App.Chat.URL) return false;
      $.post( App.Chat.URL + "contact", {user: user} , function(data){
        App.Chat.open(data);
      }, 'json').fail(function() {
      });
    },

    sendFile: function (file, user) {
      if(!file || !file.id) return false;
      if(!App.Chat.URL) return false;
      var idm = new Date().getTime();
      var message = {
        id: file.id,
        name: file['name'],
        url: file['url'],
        type: file['id_type'],
        thumb: (file['id_type'] == 1) ? '<?= base_url() ?>app/thumbc/' + file.id : ''
      };
      App.Chat.addMessage({
          id: App.userData.id,
          user: 1,
          type: 2,
          message: JSON.stringify(message),
          time: parseInt(new Date().getTime()) / 1000
        }, user.id, true);
      App.Chat.scrollBottomId(user.id);
      $.post( App.Chat.URL + "send", {
        to: user.id,
        type: 2,
        file: file.id
      } , function(data){
        if(!data || !data.result)
          return App.Chat.errorWrite(user, idm);
      }, 'json').fail(function() {
        App.Chat.errorWrite(user, idm);
      });
    },

    send: function (message, user) {
      if(message == '') return false;
      if(!App.Chat.URL) return false;
      var idm = new Date().getTime();
      App.Chat.write(message, user, idm);
      $.post( App.Chat.URL + "send", {to: user.id, message: message} , function(data){
        if(!data || !data.result)
          return App.Chat.errorWrite(user, idm);
      }, 'json').fail(function() {
        App.Chat.errorWrite(user, idm);
      });
    },

    events: {

      write: function (event, textarea, user) {
        if(event.keyCode == 27)
        {
          if(event.shiftKey == 1)
          {
            event.preventDefault();
            var box = App.Chat.getUserBox(user.id);
            if(box)
              return $('.box-head', box).click();
          }
          return App.Chat.close(user);
        }
        if(event.keyCode != 13 || event.shiftKey == 1) return App.Chat.adjustedHeight(textarea);
        event.preventDefault();
        message = textarea.val();
        message = message.replace(/^\s+|\s+$/g,"");
        textarea.val('');
        App.Chat.adjustedHeight(textarea, true);
        App.Chat.send(message, user);
        textarea.focus();
        App.Chat.pullTime = App.Chat.minPullTime;
        App.Chat.count = 1;
        return false;
      }

    },

    boxContainer: function(){
      var box = $("#widget-chat-container");
      if(box.length > 0)
        return box;
      box = $("<div id='widget-chat-container'></div>");
      $("<div id='widget-chat-bottom'>").appendTo($('body')).append(box);
      box.append($("<div class='widget-chat-more-messages'><div class='items-container'><div class='items'></div></div><div class='button'><i class='fa fa-wechat'></i><span class='count'>0</span></div></div>"));
      return box;
    },

    getUserBox: function(user){
      var box = $("#widget-chat-user-" + user);
      if (box.length > 0)
        return box;
      return false;
    },

    saveChatOrder: function(){
      var ids = [];
      if(!App.Chat.state) return;
      var items = $('#widget-chat-container .widget-chat-box:not(.reduced)');
      $.each(items.get().reverse(), function(index, el){
        var data = $(el).data('user');
        if(data && data.id)
          ids.push(data.id);
      });
      items = $('#widget-chat-container .widget-chat-box.reduced');
      $.each(items.get().reverse(), function(index, el){
        var data = $(el).data('user');
        if(data && data.id)
          ids.push(data.id);
      });
      Pace.ignore(function(){
        $.ajax({
          url: '<?= base_url() ?>app/sessiong',
          type: "POST",
          data: {
            'item': 'chat-recent',
            'value': ids.join(',')
          },
          dataType: "json"
        });
      });
    },
    removeFromMore: function(item){
      if(!item)
        item = $('#widget-chat-container .widget-chat-more-messages .items .widget-chat-box').first();
      item.removeClass('reduced').prependTo($("#widget-chat-container"));
      $('.box-head .action-close', item).addClass('tooltip-active');
      App.Chat.scrollBottom(item);
    },

    refreshMore: function(){
      var mm = $("#widget-chat-container .widget-chat-more-messages");
      var count = $('.items .widget-chat-box', mm).length;
      $('.button .count', mm).text($('.items .widget-chat-box', mm).length);
      if(!count)
        return mm.removeClass('active');
      mm.addClass('active');
      mm.removeClass('new-messages');
      if($('.items .widget-chat-box.new-messages', mm).length)
        mm.addClass('new-messages');
    },

    swapItemMore: function(item){
      var mm = $("#widget-chat-container .widget-chat-more-messages");
      var first = $("#widget-chat-container .widget-chat-box").first(), extraItem = false;
      extraItem = first.hasClass('minimized');
      first.removeClass('minimized').addClass('reduced');
      first.appendTo($('.items', mm));
      $('.box-head .action-close', first).removeClass('tooltip-active');
      if(extraItem)
      {
        first = $("#widget-chat-container .widget-chat-box").first();
        first.removeClass('minimized').addClass('reduced');
        first.appendTo($('.items', mm));
        $('.box-head .action-close', first).removeClass('tooltip-active');
      }
      App.Chat.removeFromMore(item);
      App.Chat.refreshMore();
    },

    checkBoxes: function(){
      var width = 0, maxwidth = $("#widget-chat-container").width() - 60;
      var mm = $("#widget-chat-container .widget-chat-more-messages");
      $.each($("#widget-chat-container .widget-chat-box"), function(index, el){
        el = $(el)
        if(el.hasClass('reduced')) return;
        width += el.outerWidth();
      });
      if(width <= maxwidth)
      {
        if(maxwidth - width >= 285)
        {
          App.Chat.removeFromMore();
        }
        return App.Chat.refreshMore();
      }
      var first = $("#widget-chat-container .widget-chat-box").first().removeClass('minimized').addClass('reduced');
      first.prependTo($('.items', mm));
      App.Chat.refreshMore();
    },

    validSize: function(size){
      return (size && size >= 100 && size < $(window).height() * .85);
    },

    boxAttachment: function(item, user){
      item.fileupload({
        url: '<?= base_url() ?>app/filemanager/upload',
        paramName: 'filem',
        dataType: 'json',
        formData: { folder: '5', global: 1},
        fileInput: $('.input-file-file', item),
        dropZone: item,
        progressall: function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          $('.widget-filemanager-progress', item).css(
              'width',
              progress + '%'
          );
        },
        add: function (e, data) {
          if($('.widget-filemanager-progress-bar', item).hasClass('active')) return;
          $('.box-textarea', item).val('').css('height', 28);
          $('.box-input', item).css('height', 28);
          $('.widget-filemanager-progress-bar', item).addClass('active');
          data.submit();
        },
        fail: function (e, data) {
          $('.widget-filemanager-progress-bar', item).removeClass('active success');
        },
        done: function (e, data) {
          if(data.result.result)
          {
            App.Chat.sendFile(data.result.data, user);
          }
          $('.widget-filemanager-progress-bar', item).addClass('success');
          setTimeout(function () {
            $('.widget-filemanager-progress-bar', item).removeClass('active');
          }, 1000);
          setTimeout(function () {
            $('.widget-filemanager-progress-bar', item).removeClass('success');
            $('.widget-filemanager-progress', item).css('width', 0);
          }, 2000);
        }
      });
      item.bind('dragover', function (e) {
        if($('.widget-filemanager-progress-bar', item).hasClass('active')) return;
        timeout = item.dropZoneTimeout;
        if (!timeout) {
            item.addClass('dragover');
        } else {
            clearTimeout(timeout);
        }
        var found = false, node = e.target;
        do {
            if (node === item[0]) {
                found = true;
                break;
            }
            node = node.parentNode;
        } while (node != null);
        if (found) {
            item.addClass('dragover');
        } else {
            item.removeClass('dragover');
        }
        item.dropZoneTimeout = setTimeout(function () {
            item.dropZoneTimeout = null;
            item.removeClass('dragover');
            App.clearGarbage();
        }, 100);
        item.addClass('dragover');
      });
    },

    userBox: function(user, state, size){
      if(!user || !user.id) return false;
      state = (state) ? state : 0;
      var box = $("#widget-chat-user-" + user.id);
      if (box.length > 0)
      {
        if(box.hasClass('minimized') && !state)
          $('.box-head', box).click();
        return box;
      }
      var box = $(" <div />" ).attr("id","widget-chat-user-"+user.id)
        .addClass("widget-chat-box")
        .addClass("widget-chat-box-loading")
        .html('<div class="box-container"><div class="box-resizable"><div class="box-resizable-element"></div></div><div class="box-head"><div class="box-title"><div class="box-new-messages">0</div><div class="box-status status-'+user.status+'"><div class="status-point"></div></div><span class="box-user-name">'+user.name+'</span></div><div class="box-options"><a class="ico-global action-close"></a></div></div><div class="box-content-file"><i class="ico-file fa fa-upload"></i></div><div class="box-content"><div class="box-content-inside"></div></div><div class="box-input widget-filemanager"><div class="widget-filemanager-progress-bar"><div class="widget-filemanager-progress"></div></div><textarea class="box-textarea"></textarea><div data-title="<?= $this->lang->line("Subir archivo") ?>" class="box-input-file tooltip-chat tooltip-active"><input type="file" class="input-file-file" /><i class="fa fa-upload"></i></div></div></div>')
        .prependTo(App.Chat.boxContainer());

      box.data('user', user);
      box.draggable({
        axis: "x" ,
        distance: 0,
        delay: 100,
        helper: "clone",
        start: function( event, ui ) {
          var $this = $(this);
          var items = $('.widget-chat-box:not(.reduced)', App.Chat.boxContainer());
          if(items.length < 3 || $this.hasClass('reduced'))
          {
            event.preventDefault();
            return false;
          }
          App.Chat.scrollBottom(ui.helper);
          event.stopPropagation();
          $this.css('visibility','hidden');
          $.each(items, function(index, item){
            $(item).attr('data-index', index);
          });
        },
        handle: ".box-head",
        stop: function( event, ui ) {
          var $this = $(this);
          $this.css('visibility','visible');
          setTimeout(function(){
            $this.removeClass('draggable-dragging');
            App.Chat.saveChatOrder();
          }, 100);
          event.stopPropagation();
        },
        drag: function( event, ui ) {
          var $this = $(this), left = ui.offset.left, moving = 1, indexIt = $this.attr('data-index');
          var items = $('.widget-chat-box:not(.reduced)', App.Chat.boxContainer());
          if(ui.position.left > ui.originalPosition.left)
            moving = - moving;
          event.stopPropagation();
          var swap = false;
          if(moving < 0 ) items = items.get().reverse();
          $.each(items, function(index, item){
            var item = $(item);
            if( item == $this || swap) return;
            if(moving > 0)
            {
              if(item.attr('data-index') >= indexIt) return;
              if( item.offset().left + item.width() * .6 > left )
              {
                $this.after(item);
                App.Chat.scrollBottom(item);
                App.Chat.scrollBottom($this);
                swap = true;
              }
            }
            else
            {
              if(item.attr('data-index') <= indexIt) return;
              if( item.offset().left < left + $(this).width() * .6 )
              {
                $this.before(item);
                App.Chat.scrollBottom(item);
                App.Chat.scrollBottom($this);
                swap = true;
              }
            }
          });
          if(swap)
          {
            $.each($('.widget-chat-box:not(.reduced)', App.Chat.boxContainer()), function(index, item){
              $(item).attr('data-index', index);
            });
          }
        }
      });

      if(App.Chat.validSize(size))
        $('.box-content', box).height(size);
      App.Chat.boxAttachment(box, user);

      $('.box-resizable .box-resizable-element', box).draggable({
        axis: "y" ,
        cursor: "n-resize",
        distance: 0,
        start: function( event, ui ) {
          $('.box-content', box).attr('data-height', $('.box-content', box).height());
        },
        stop: function( event, ui ) {
          App.Chat.scrollBottomId(user.id);
          if($('.box-content', box).height() == $('.box-content', box).attr('data-height')) return;
          $.post( App.Chat.URL + "size", {user: user.id, size: $('.box-content', box).height()} , function(data){}, 'json');
        },
        drag: function( event, ui ) {
          var nh = $('.box-content', box).attr('data-height') - ui.position.top;
          if(!App.Chat.validSize(nh))
            return event.preventDefault();
          $('.box-content', box).height(nh);
        }
      });
      if(state == 1)
        box.addClass('minimized');

      $.post( App.Chat.URL + "messages", {user: user.id} , function(data){
        App.Chat.addMessages(user.id, data);
        if(!box.hasClass('minimized') && box.hasClass('new-messages') && state < 2)
        {
          box.removeClass('new-messages');
          App.Title.set('alt', false);
        }
        box.removeClass("widget-chat-box-loading");
        App.Chat.scrollBottomId(user.id);
      }, 'json');

      $('.box-content', box).bind('mousewheel DOMMouseScroll', function(e)  {
        var delta = e.originalEvent.wheelDelta || -e.originalEvent.detail;
        if (delta > 0 && $(this).scrollTop() <= 0)
            return false;
        if (delta < 0 && $(this).scrollTop() >= this.scrollHeight - $(this).height())
            return false;
        return true;
      });

      $('.box-textarea', box).keydown(function(e) {
        App.Chat.events.write(e, $(this), user);
      }).focus(function(){
        App.Chat.read(user.id);
      });

      $('.box-head', box).click(function() {
        if(box.hasClass('draggable-dragging')) return;
        if(box.hasClass('reduced'))
        {
          App.Chat.swapItemMore(box);
          App.Chat.read(user.id, true);
          App.Chat.scrollBottomId(user.id);
          $(".box-textarea", box).focus();
          App.Chat.checkBoxes();
          App.Chat.saveChatOrder();
          return;
        }
        box.toggleClass('minimized');
        if(box.hasClass('minimized'))
        {
          $('.box-head .action-close', box).removeClass('tooltip-active');
          $.post( App.Chat.URL + "minimize", {user: user.id} , function(data){}, 'json');
        }
        else
        {
          $('.box-head .action-close', box).addClass('tooltip-active');
          App.Chat.read(user.id, true);
          App.Chat.scrollBottomId(user.id);
          $(".box-textarea", box).focus();
        }
        App.Chat.checkBoxes();
      });
      box.tooltip(App.Chat.tooltip());
      $('.box-head .action-close', box).addClass('tooltip-chat' + (state == 1 ? '' : ' tooltip-active')).attr('data-title','<?= $this->lang->line("Cerrar pestaña") ?>').click(function(e) {
        if(e) e.stopPropagation();
        App.Chat.close(user);
      });
      box.click(function() {
        if(!box.hasClass('minimized') && !box.hasClass('hide'))
          $(".box-textarea", box).focus();
      });
      return box;

    },

    read: function(user, force){
      var box = App.Chat.getUserBox(user);
      if(box.hasClass('new-messages') || force)
        $.post( App.Chat.URL + "open", {user: user} , function(data){}, 'json');
      if(box.hasClass('new-messages'))
      {
        box.removeClass('new-messages');
        App.Title.set('alt', false);
      }
    },

    close: function(user){
      $.post( App.Chat.URL + "close", {user: user.id} , function(data){}, 'json');
      var box = App.Chat.getUserBox(user.id);
      if(box.hasClass('new-messages'))
      {
        box.removeClass('new-messages');
        App.Title.set('alt', false);
      }
      box.remove();
      App.Chat.saveChatOrder();
      App.Chat.boxContainer();
      App.Chat.checkBoxes();
      App.clearGarbage();
    },

    open: function(user, state, size){
      var box = App.Chat.userBox(user, state, size);
      App.Chat.checkBoxes();
      if(box.hasClass('reduced') && App.Chat.state)
      {
        App.Chat.swapItemMore(box);
      }
      App.Chat.saveChatOrder();
      App.Chat.scrollBottomId(user.id);
      $("#widget-chat-user-" + user.id + " .box-textarea").focus();
    }

  },

  changeURI: function(url) {
    if( window.history == undefined || window.history.pushState == undefined ) return;
    if(window.location.href == url) return;
    if($('body').hasClass('forced-quick-open')) return;
    return window.history.pushState({}, "", url);
  },

  requiredScript: function(required){
    var scripts = [];
    $.each($('script'), function(index, script){
      if($(script).attr('src'))
        scripts.push($(script).attr('src'))
    });
    $.each(required, function(index, script){
      if($.inArray(script, scripts) > -1) return;
      $('<script src="' + script + '"></script>').appendTo($('head'));
    });
  },

  clearGarbage: function(){
  	$('.DTTT_dropdown').remove();
  	$('.FixedHeader_Cloned').remove();
    $('.tooltip-close-chat').remove();
    $('.tooltip-hour').remove();
    $('.tooltip-nz').remove();
  },

  changeMenu: function(menu, submenu){
    $('#header .user-info').removeClass('active');
    if($('#menu nav').length)
    {
    	$('#menu nav ul li').removeClass('current open').find('.active').removeClass('active');
    	$('#menu nav ul li a.item-' + menu).addClass('active').parent('li').addClass('current').addClass('open');
    	$('#menu nav ul li a.item-' + menu + '-' + submenu).parent().addClass('active');
    	return;
    } 
		/* Legacy */
    $('#left-panel nav ul li a.active').removeClass('active');
    $('#left-panel nav ul li a.item-' + menu).addClass('active').parent('li').addClass('current').addClass('open');
    $('#left-panel nav ul li a.item-' + menu + '-' + submenu).addClass('active');
  
    setTimeout(function(){
      nav_page_height();
    },$.menu_speed + 10);
  },


  clearBody: function(){
    $('#main').html('');
    App.clearGarbage();
  },

  clearStorage: false,

  postForm: function(form){
  	if($.isFunction(App.clearStorage))
  	{
  		App.clearStorage();
  	}
    form = $(form);
    var url = form.attr('action');
    if(!url) url = window.location.href;
    App.changeURI(url);
    App.clearBody();
    $.ajax({
      type: "POST",
      cache: true,
      url: url,
      data: form.serialize(),
      dataType: "html",
      processData: false
    }).done(function(html) {
      $('#main').replaceWith(html);
      App.loaderLink();
    });
  },
  loadURL: function(url, change){
    if(change) App.changeURI(url);
    App.clearBody();
    $.ajax({
      cache: true,
      url: url,
      dataType: "html",
      processData: false
    }).done(function(html) {
    	$('#main').nextAll().filter('script').each(function(index, el) {
    		if ($(el).attr('src') || $(el).hasClass('js-no-garbage')) return;
    		$(el).remove();
    	});
      $('#main').replaceWith(html);
      App.loaderLink();
    });
  },
  loadURLWait: function(url, change){
    if(change) App.changeURI(url);
    App.clearGarbage();
    $('#main').css({'opacity': .4, 'pointer-events': 'none'});
    $.ajax({
      cache: true,
      url: url,
      dataType: "html",
      processData: false
    }).done(function(html) {
    	$('#main').nextAll().filter('script').each(function(index, el) {
    		if ($(el).attr('src') || $(el).hasClass('js-no-garbage')) return;
    		$(el).remove();
    	});
      $('#main').replaceWith(html);
      App.loaderLink();
    });
  },
  refreshItems: function(){
    setTimeout(function(){
      $(window).resize();
    }, 320);
  },
  loaderLink: function(links){
    App.StoreSessionAdmin();    
    links = links ? links : $('.app-loader');
    links.click(function(e) {
      if(e && (e.which == 2 || e.ctrlKey))
      {
        e.stopPropagation();
        return;
      }
      App.loadURL($(this).attr('href'), $(this).attr('data-uri') ? false : true);
      e.preventDefault();
      return false;
    });
    links.removeClass('app-loader');

    $('.widget-app-element:not(.render)').each(function(index, el) {
      var adminLang = typeof localStorage != 'undefined' ? localStorage.getItem('AdminLang') : false;
      $(el).addClass('render').on('click', '.app-langs span', function(event) {
        $('.app-langs span', el).removeClass('active');
        $(this).addClass('active');
        $('.elem-lang', el).css('display', 'none');
        $('.elem-lang-' + $(this).attr('data-id'), el).css('display', 'block');
        if (typeof localStorage != 'undefined')
        {
          localStorage.setItem('AdminLang', $(this).attr('data-id'));
        }
      });
      
      if(adminLang)
      {
        $(el).find('.app-langs span.lang-'+adminLang).eq(0).click();                
      }
      else
      {
        $(el).find('.app-langs span').eq(0).click();        
      }
    });
  
    $('.form-post-color').off('change').change(function(e) {
    	$(this).next().val($(this).val().toUpperCase());
    });

    $('.form-post-color-value').off('blur').blur(function(e) {
    	$(this).val($(this).val().toUpperCase());
    	$(this).prev().val($(this).val());
    });

    $('#main').tooltip({
      selector: '.tooltip-nz-app.ttactive',
      title: function(){
        return $(this).attr('data-title') || $(this).attr('title');
      },
      html: true,
      trigger: 'hover',
      container: 'body',
      template: '<div class="tooltip tooltip-nz" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
      placement: 'top'
    });

    $('#header').tooltip({
      selector: '.tooltip-nz-app.ttactive',
      title: function(){
        return $(this).attr('data-title') || $(this).attr('title');
      },
      container: 'body',
      trigger: 'hover',
      template: '<div class="tooltip tooltip-nz" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
      placement: 'bottom'
    });

  }
};

$(document).ready(function() {
  App.loaderLink();
  App.Title.activate();
  if(App.userData)
  {
    App.Chat.Contacts.refresh();
  }
  if ($('aside#left-panel nav').length)
  {

  	$('aside#left-panel nav ul.menu').on('click', '> li a', function(event) {
  		event.preventDefault();
  		var li = $(this).parent(), open = li.hasClass('open');
  		$('aside nav ul.menu > li.open').removeClass('open');
  		li.toggleClass('open', ! open)
  	});
  	
	  $(window).scroll(function() {
	    if($(window).height() < $('#left-panel nav').height())
	    {
	      $('#left-panel').addClass('no-fixed');
	      return $('#left-panel nav').css('margin-top', 0);
	    }
	    var mt = 40 - $(window).scrollTop();
	    if(mt<0) mt = 0;
	    $('#left-panel').removeClass('no-fixed');
	  });
  
	  $('.minifyme').click(function(e) {
	    $('body').toggleClass("minified");
	    Pace.ignore(function(){
	      $.ajax({
	        url: '<?= base_url() ?>app/sessiong',
	        type: "POST",
	        data: {
	          'item': 'body-minified',
	          'value': $('body').hasClass("minified") ? "1" : "0"
	        },
	        dataType: "json"
	      });
	    });
	    $(this).effect("highlight", {}, 500);
	    e.preventDefault();
	    App.refreshItems();
	  });
	  
	  $('header .action-hide-menu a').click(function(e) {
	    App.clearGarbage();
	    $('body').toggleClass("hidden-menu");
	    Pace.ignore(function(){
	      $.ajax({
	        url: '<?= base_url() ?>app/sessiong',
	        type: "POST",
	        data: {
	          'item': 'hidden-menu',
	          'value': $('body').hasClass("hidden-menu") ? "1" : "0"
	        },
	        dataType: "json"
	      });
	    });
	    e.preventDefault();
	    App.refreshItems();
	  });
  }
  if ($('aside#menu nav').length)
  {
  	var menu_offset = 10, menu_max = $('header').outerHeight();
  	$('aside nav ul.menu').on('click', '> li a', function(event) {
  		event.preventDefault();
  		var li = $(this).parent(), open = li.hasClass('open');
  		$('aside nav ul.menu > li.open').removeClass('open');
  		li.toggleClass('open', ! open)
  	});
	  $(window).scroll(function() {
	    var mt = menu_max, st = $(window).scrollTop();
	    if(st >= mt + menu_offset)
	    {
	    	mt = st - menu_offset;
	    }
	    $('#menu').css('top', mt);
	  });
  }
  
  $('#widget-notifications').click(function(e) {
    e.stopPropagation();
  });
  
  $('#widget-notifications .widget-footer .widget-footer-inside a, header .action-notifications a').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    App.clearGarbage();
    $('body').toggleClass('show-notification');
    if($('body').hasClass('show-notification'))
    {
      App.Notifications.refresh();
      $('html, body').one("click", function(){
        $('body').removeClass('show-notification');
      });
    }
  });
  
  $('header .action-chat a').click(function(e) {
    e.preventDefault();
    App.clearGarbage();
    $('body').toggleClass('chat-active');
    Pace.ignore(function(){
      $.ajax({
        url: '<?= base_url() ?>app/sessiong',
        type: "POST",
        data: {
          'item': 'chat-active',
          'value': $('body').hasClass("chat-active") ? "1" : "0"
        },
        dataType: "json"
      });
    });
    App.Chat.Contacts.refresh();
    App.refreshItems();
  });
  
  App.Notifications.prepare();
  
  $('header .action-logout a').click(function(e) {
    var $this = $(this);
    $.SmartMessageBox({
      title : "<i class='fa fa-sign-out txt-color-orangeDark'></i> <?= $this->lang->line("¿Está seguro que desea cerrar sesión?") ?> <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span>",
      buttons : '[<?= $this->lang->line("No") ?>][<?= $this->lang->line("Si") ?>]'
    }, function(ButtonPressed) {
      if (ButtonPressed == "<?= $this->lang->line("Si") ?>") {
        window.location = $this.attr('href');
      }
    });
    $("#MsgBoxBack .MessageBoxMiddle").addClass('MessageBoxMiddleLogout');
    $($("#MsgBoxBack .MessageBoxButtonSection button")[1]).addClass('btn-primary');
    e.preventDefault();
  });
  
  $(window).scroll();
  
});

function nav_page_height() {
  var setHeight = $('#main').height();
  var windowHeight = $(window).height() - $.navbar_height;
  $.root_.css('min-height', windowHeight);
  if($('#left-panel').height() < $('#left-panel nav').height() + 40) 
  {
    $.left_panel.css('min-height', ($('#left-panel nav').height() + 40) + 'px');
  }
  else if (setHeight > windowHeight) 
  {
    $.left_panel.css('min-height', setHeight + 'px');
  } 
  else 
  {
    $.left_panel.css('min-height', windowHeight + 'px');
  }
}

jQuery.fn.doesExist = function() {
  return jQuery(this).length > 0;
};

Date.prototype.format = function(format)
{
  var o = {
    "M+" : this.getMonth()+1,
    "d+" : this.getDate(),
    "h+" : this.getHours(),
    "m+" : this.getMinutes(),
    "s+" : this.getSeconds(),
    "q+" : Math.floor((this.getMonth()+3)/3),
    "S" : this.getMilliseconds()
  }
  if(/(y+)/.test(format)) format=format.replace(RegExp.$1,
    (this.getFullYear()+"").substr(4 - RegExp.$1.length));
  for(var k in o)if(new RegExp("("+ k +")").test(format))
    format = format.replace(RegExp.$1,
      RegExp.$1.length==1 ? o[k] :
        ("00"+ o[k]).substr((""+ o[k]).length));
  return format;
}
$.validator.setDefaults({
  submitHandler: function(form) {
    App.postForm(form);
  },
  errorPlacement : function(error, element) {
    error.insertAfter(element.parent());
  }
});
$.validator.addMethod("select", function(value, element) {
  return value.trim().length>0;
}, "<?= $this->lang->line("Campo obligatorio") ?>");
$.validator.messages.required = '<?= $this->lang->line("Campo obligatorio") ?>';
$.validator.messages.email = '<?= $this->lang->line("Por favor, introduce una dirección de correo electrónico válida") ?>';
$.validator.messages.minlength = '<?= $this->lang->line("Por favor, introduzca al menos {0} caracteres") ?>';
$.validator.messages.maxlength = '<?= $this->lang->line("Por favor, introduzca un máximo de {0} caracteres") ?>';
$.validator.messages.min = '<?= $this->lang->line("Por favor, introduzca un valor mayor o igual a {0}") ?>';
$.validator.messages.max = '<?= $this->lang->line("Por favor, introduzca un valor menor o igual a {0}") ?>';
$.validator.messages.equalTo = '<?= $this->lang->line("Por favor, introduzca el mismo valor") ?>';

Date.fromMysql = function(string) {
  if(typeof string === 'string')
  {
    var t = string.split(/[- :]/);
    return new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
  }
  return null;
};

var shadeColor = function (color, percent) {
  var f=parseInt(color.slice(1),16),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=f>>16,G=f>>8&0x00FF,B=f&0x0000FF;
  return "#"+(0x1000000+(Math.round((t-R)*p)+R)*0x10000+(Math.round((t-G)*p)+G)*0x100+(Math.round((t-B)*p)+B)).toString(16).slice(1);
};

function strtotime(text, now) {
  //  discuss at: http://phpjs.org/functions/strtotime/
  //     version: 1109.2016
  // original by: Caio Ariede (http://caioariede.com)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Caio Ariede (http://caioariede.com)
  // improved by: A. Matías Quezada (http://amatiasq.com)
  // improved by: preuter
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Mirko Faber
  //    input by: David
  // bugfixed by: Wagner B. Soares
  // bugfixed by: Artur Tchernychev
  //        note: Examples all have a fixed timestamp to prevent tests to fail because of variable time(zones)
  //   example 1: strtotime('+1 day', 1129633200);
  //   returns 1: 1129719600
  //   example 2: strtotime('+1 week 2 days 4 hours 2 seconds', 1129633200);
  //   returns 2: 1130425202
  //   example 3: strtotime('last month', 1129633200);
  //   returns 3: 1127041200
  //   example 4: strtotime('2009-05-04 08:30:00 GMT');
  //   returns 4: 1241425800

  var parsed, match, today, year, date, days, ranges, len, times, regex, i, fail = false;

  if (!text) {
    return fail;
  }

  // Unecessary spaces
  text = text.replace(/^\s+|\s+$/g, '')
    .replace(/\s{2,}/g, ' ')
    .replace(/[\t\r\n]/g, '')
    .toLowerCase();

  // in contrast to php, js Date.parse function interprets:
  // dates given as yyyy-mm-dd as in timezone: UTC,
  // dates with "." or "-" as MDY instead of DMY
  // dates with two-digit years differently
  // etc...etc...
  // ...therefore we manually parse lots of common date formats
  match = text.match(
    /^(\d{1,4})([\-\.\/\:])(\d{1,2})([\-\.\/\:])(\d{1,4})(?:\s(\d{1,2}):(\d{2})?:?(\d{2})?)?(?:\s([A-Z]+)?)?$/);

  if (match && match[2] === match[4]) {
    if (match[1] > 1901) {
      switch (match[2]) {
        case '-':
          { // YYYY-M-D
            if (match[3] > 12 || match[5] > 31) {
              return fail;
            }

            return new Date(match[1], parseInt(match[3], 10) - 1, match[5],
              match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
          }
        case '.':
          { // YYYY.M.D is not parsed by strtotime()
            return fail;
          }
        case '/':
          { // YYYY/M/D
            if (match[3] > 12 || match[5] > 31) {
              return fail;
            }

            return new Date(match[1], parseInt(match[3], 10) - 1, match[5],
              match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
          }
      }
    } else if (match[5] > 1901) {
      switch (match[2]) {
        case '-':
          { // D-M-YYYY
            if (match[3] > 12 || match[1] > 31) {
              return fail;
            }

            return new Date(match[5], parseInt(match[3], 10) - 1, match[1],
              match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
          }
        case '.':
          { // D.M.YYYY
            if (match[3] > 12 || match[1] > 31) {
              return fail;
            }

            return new Date(match[5], parseInt(match[3], 10) - 1, match[1],
              match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
          }
        case '/':
          { // M/D/YYYY
            if (match[1] > 12 || match[3] > 31) {
              return fail;
            }

            return new Date(match[5], parseInt(match[1], 10) - 1, match[3],
              match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
          }
      }
    } else {
      switch (match[2]) {
        case '-':
          { // YY-M-D
            if (match[3] > 12 || match[5] > 31 || (match[1] < 70 && match[1] > 38)) {
              return fail;
            }

            year = match[1] >= 0 && match[1] <= 38 ? +match[1] + 2000 : match[1];
            return new Date(year, parseInt(match[3], 10) - 1, match[5],
              match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
          }
        case '.':
          { // D.M.YY or H.MM.SS
            if (match[5] >= 70) { // D.M.YY
              if (match[3] > 12 || match[1] > 31) {
                return fail;
              }

              return new Date(match[5], parseInt(match[3], 10) - 1, match[1],
                match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
            }
            if (match[5] < 60 && !match[6]) { // H.MM.SS
              if (match[1] > 23 || match[3] > 59) {
                return fail;
              }

              today = new Date();
              return new Date(today.getFullYear(), today.getMonth(), today.getDate(),
                match[1] || 0, match[3] || 0, match[5] || 0, match[9] || 0) / 1000;
            }

            return fail; // invalid format, cannot be parsed
          }
        case '/':
          { // M/D/YY
            if (match[1] > 12 || match[3] > 31 || (match[5] < 70 && match[5] > 38)) {
              return fail;
            }

            year = match[5] >= 0 && match[5] <= 38 ? +match[5] + 2000 : match[5];
            return new Date(year, parseInt(match[1], 10) - 1, match[3],
              match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
          }
        case ':':
          { // HH:MM:SS
            if (match[1] > 23 || match[3] > 59 || match[5] > 59) {
              return fail;
            }

            today = new Date();
            return new Date(today.getFullYear(), today.getMonth(), today.getDate(),
              match[1] || 0, match[3] || 0, match[5] || 0) / 1000;
          }
      }
    }
  }

  // other formats and "now" should be parsed by Date.parse()
  if (text === 'now') {
    return now === null || isNaN(now) ? new Date()
      .getTime() / 1000 | 0 : now | 0;
  }
  if (!isNaN(parsed = Date.parse(text))) {
    return parsed / 1000 | 0;
  }

  date = now ? new Date(now * 1000) : new Date();
  days = {
    'sun': 0,
    'mon': 1,
    'tue': 2,
    'wed': 3,
    'thu': 4,
    'fri': 5,
    'sat': 6
  };
  ranges = {
    'yea': 'FullYear',
    'mon': 'Month',
    'day': 'Date',
    'hou': 'Hours',
    'min': 'Minutes',
    'sec': 'Seconds'
  };

  function lastNext(type, range, modifier) {
    var diff, day = days[range];

    if (typeof day !== 'undefined') {
      diff = day - date.getDay();

      if (diff === 0) {
        diff = 7 * modifier;
      } else if (diff > 0 && type === 'last') {
        diff -= 7;
      } else if (diff < 0 && type === 'next') {
        diff += 7;
      }

      date.setDate(date.getDate() + diff);
    }
  }

  function process(val) {
    var splt = val.split(' '), // Todo: Reconcile this with regex using \s, taking into account browser issues with split and regexes
      type = splt[0],
      range = splt[1].substring(0, 3),
      typeIsNumber = /\d+/.test(type),
      ago = splt[2] === 'ago',
      num = (type === 'last' ? -1 : 1) * (ago ? -1 : 1);

    if (typeIsNumber) {
      num *= parseInt(type, 10);
    }

    if (ranges.hasOwnProperty(range) && !splt[1].match(/^mon(day|\.)?$/i)) {
      return date['set' + ranges[range]](date['get' + ranges[range]]() + num);
    }

    if (range === 'wee') {
      return date.setDate(date.getDate() + (num * 7));
    }

    if (type === 'next' || type === 'last') {
      lastNext(type, range, num);
    } else if (!typeIsNumber) {
      return false;
    }

    return true;
  }

  times = '(years?|months?|weeks?|days?|hours?|minutes?|min|seconds?|sec' +
    '|sunday|sun\\.?|monday|mon\\.?|tuesday|tue\\.?|wednesday|wed\\.?' +
    '|thursday|thu\\.?|friday|fri\\.?|saturday|sat\\.?)';
  regex = '([+-]?\\d+\\s' + times + '|' + '(last|next)\\s' + times + ')(\\sago)?';

  match = text.match(new RegExp(regex, 'gi'));
  if (!match) {
    return fail;
  }

  for (i = 0, len = match.length; i < len; i++) {
    if (!process(match[i])) {
      return fail;
    }
  }

  // ECMAScript 5 only
  // if (!match.every(process))
  //    return false;

  return (date.getTime() / 1000);
}
$(window).on('popstate', function() {
  App.loadURL(window.location.href, false);
});


String.prototype.strip_tags = function(){
	return this.replace(/(<([^>]+)>)/ig, '');
};
String.prototype.strip_all = function(){
	return this.strip_tags().replace(/(\r\n|\n|\r)/gm, ' ');
};
String.prototype.truncateToMaxWords = function (maxWords) {
	var string = this;
  var whitespace = string.match(/\s+/g);
  var words = string.split(/\s+/);
  var finished = [];
  for(var i = 0; i < maxWords && words.length > 0; i++)
  {
    if(words[0] == "") { i--; }
    finished.push(words.shift());
    if(whitespace && whitespace.length)
      finished.push(whitespace.shift());
    else
      finished.push(' ');
  }
  return finished.join('');
};
String.prototype.capitalize = function() {
  return this.charAt(0).toUpperCase() + this.slice(1);
}
String.prototype.htmlentitiesdecode = function(){
  var entities = [
	  ['amp', '&'],
	  ['apos', '\''],
	  ['#x27', '\''],
	  ['#x2F', '/'],
	  ['#39', '\''],
	  ['#47', '/'],
	  ['lt', '<'],
	  ['gt', '>'],
	  ['nbsp', ' '],
	  ['quot', '"']
  ];
  var text = this;
  for (var i = 0, max = entities.length; i < max; ++i)
    text = text.replace(new RegExp('&'+entities[i][0]+';', 'g'), entities[i][1]);
  return text;
}
String.prototype.htmlentities = function(){
  return this
    .replace(/&/g, "&amp;")
    .replace(/>/g, "&gt;")
    .replace(/</g, "&lt;")
    .replace(/'/g, "&#039;")
    .replace(/"/g, "&quot;");
}

Number.prototype.round_value = function(){
  var decimals_len = Math.pow(10, (this + '').length + 1);
  return Math.round(this * decimals_len) / decimals_len;
};

String.prototype.round_value = Number.prototype.round_value;

$.extend(App, {

  Default : function(item, opts) {
    var base = App.Defaults.default;
    var data = base;
    var path = item.split('.'), rpath = App.Defaults, exit = false;
    $.each(path, function(index, val) {
      if(exit) return;
      if(rpath[val] == undefined)
      {
        exit = true;
        return;
      }
      rpath = rpath[val];
    });
    if(!exit)
    {
      if($.isPlainObject(rpath)) 
      {
      	data = rpath;
      }
      else if($.isFunction(rpath)) 
      {
      	data = rpath(opts);
      }
    }
    if($.isPlainObject(data)) 
    {
    	return $.extend(true, base, data, opts);
    }
    return data;
  },

  Defaults : {

    default : {},

    modal: {
	    confirm : function(data) {
    		return '<div class="modal fade modal-admin" tabindex="-1" role="dialog" aria-hidden="false"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h2 class="modal-title" id="exampleModalLabel">{modal_title}</h2><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">{modal_body}</div><div class="modal-footer"><button type="button" class="btn btn-primary button-confirm" data-dismiss="modal">{label-btn-1}</button><button type="button" class="btn btn-default" data-dismiss="modal">{label-btn-2}</button></div></div></div></div>'
				.replace('{label-btn-1}', data.button1 || __LOCAL('Confirmar'))
				.replace('{label-btn-2}', data.button2 || __LOCAL('Cancelar'))
				.replace('{modal_title}', data.title || '')
				.replace('{modal_body}', data.body || '');
		  },
	  },
    
    ambiance : {
      error : function() {
        return { width: 'auto', timeout: 4, type: "error" };
      },
      success : function() {
        return { width: 'auto', timeout: 4, type: "success" };
      }
    }
  }

});
