var ckCfg = {
	customConfig: '',
	language: '<?= $this->MApp->lang ?>',
	resize_enabled: false,
	colorButton_enableMore: true,
	format_tags: 'p;h1;h2;h3',
	height: 250,
	dialog_noConfirmCancel: true,
	enterMode: CKEDITOR.ENTER_BR,
	magicline_color: '#000000',

	coreStyles_bold: {element:'span', attributes:{ 'class':'app-span-bold' } },
	coreStyles_italic: {element:'span', attributes:{ 'class':'app-span-italic' } },
	coreStyles_underline: {element:'span', attributes:{'class':'app-span-underline' } },
	coreStyles_strike: {element:'span', attributes:{ 'class':'app-span-strike' } },
	colorButton_foreStyle : {
		element: 'span',
		styles: { 'color': '#(color)' },
		ignoreReadonly: true,
		overrides: [ {
			element: 'font', attributes: { 'color': '000000' }
		}]
	},
	colorButton_backStyle : {
		element: 'span',
		styles: { 'background-color': '#(color)' },
		ignoreReadonly: true,
	},
	font_defaultLabel : 'Roboto',
	font_names: 'Roboto;',
	format_tags: 'p;h1;h2;h3',
	font_style : {
		element: 'span',
		styles: { 'font-family': '#(family)' },
		ignoreReadonly: true,
		overrides: [ {
			element: 'font', attributes: { 'face': null }
		}]
	},
	stylesSet: [
		{ name: 'Regular text', element: 'p', styles : { color : '#ff0000'}  },
		{ name: 'Thin text', element: 'span', attributes: { 'class': 'app-span-thin' } },
		{ name: 'Title 1' , element: 'h1'},
		{ name: 'Title 2', element: 'h2'},

		{
			name: 'Align left',
			element: 'img',
			attributes: { 'class': 'left' }, group: 'alignment' 
		},
		{
			name: 'Align right',
			element: 'img',
			attributes: { 'class': 'right' }, group: 'alignment' 
		},
		{
			name: 'Align center',
			element: 'img',
			attributes: { 'class': 'center' }, group: 'alignment' 
		},

		{ name: 'Grayscale', element: 'span', attributes: { 'class': 'app-span-grayscale' } },

		{ name: 'Regular Table', element: 'table',	attributes: { 'class': 'table-border' } },
		{ name: 'Borderless Table', element: 'table',	attributes: { 'class': 'table-no-border' } },

		{ name: 'Square Bulleted List',	element: 'ul',		styles: { 'list-style-type': 'square' } },

		{ name: 'Clean Image', type: 'widget', widget: 'embed', attributes: { 'class': 'image-clean' } },
		{ name: 'Grayscale Image', type: 'widget', widget: 'embed', attributes: { 'class': 'image-grayscale' } },

		{ name: '240p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-240p' } },
		{ name: '360p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-360p' } },
		{ name: '480p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-480p' } },
		{ name: '720p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-720p' } },
		{ name: '1080p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-1080p' } },
		
	],
	fontSize_style : {
		element: 'span',
		styles: { 'font-size': '#(size)' },
		ignoreReadonly: true,
		overrides: [ {
			element: 'font', attributes: { 'size': null },
		}]
	},
	fontSize_defaultLabel: '14px',
	embed_provider :'//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
	coreStyles_bold: {element:'span', attributes:{'class':'app-span-bold'}},
	coreStyles_italic: {element:'span', attributes:{'class':'app-span-italic'}},
	coreStyles_underline: {element:'span', attributes:{'class':'app-span-underline'}},
	coreStyles_strike: {element:'span', attributes:{'class':'app-span-strike'}},
	extraPlugins: `justify`,
	removePlugins: `image2,uploadimage,uploadfile,filebrowser,about,a11yhelp,bidi,templates,
	elementspath,enterkey,entities,flash,floatingspace,forms,magicline,newpage,pagebreak,smiley,
	showblocks, showborders,specialchar`,
	removeDialogTabs: 'image:advanced;link:advanced',
	image2_alignClasses: [ 'app-align-left', 'app-align-center', 'app-align-right' ],
	image2_disableResizer: false,
	image2_prefillDimensions: false,
	colorButton_colors:'000000,ffffff,2be9ce,FFED00,D58AEF',
	autosave:{
		messageType:"statusbar",
	},
	toolbar: [
	// {"items":["Source","-","Cut","Copy","Paste","-","PasteText","PasteFromWord"]},
	// {"items":["Undo","Redo","-","Find","Replace","-","JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock", 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
	// {"items":["Link","Unlink"]},
	// {"items":["Styles","Font","FontSize","-","TextColor","-","Bold","Italic","Underline","Strike","-","RemoveFormat", "-", "Image", "Table", "EmbedSemantic"]},
	{"items":["TextColor","-","Bold","Italic","Underline","Strike","-","RemoveFormat"]},
	],
}; 

App.clearStorage = false;
CKEDITOR.on('dialogDefinition', function( ev ){
	var dialogName = ev.data.name;
	var dialog = ev.data.definition;
	if ( dialogName == 'image' ) {
		dialog.getContents('info').remove('cmbAlign');
		dialog.getContents('info').remove('txtBorder');
		dialog.getContents('info').remove('txtHSpace');
		dialog.getContents('info').remove('txtVSpace');
	}
	if ( dialogName == 'autosaveDialog' ) {
		dialog.width = $(window).width() * .80;  	
		if(dialog.width>881) dialog.width = 881
			var rr = dialog.onShow;
		App.clearStorage = dialog.onCancel.bind(dialog.dialog);
		dialog.onShow = function(){
			<?php if($this->session->flashdata('post-save-ok-'.$idItem)): ?>
			return;
			<?php endif ?>
			rr.apply(dialog.dialog);
			dialog.dialog._.contents.general.diffType.getElement().hide();
			$('.diffContent').addClass('ck-editor__editable');
			$('.diffContent .diff tr').last().html('');
			$('.diffContent .diff tbody tr').each(function(index, el) {
				$('td', el).each(function(index, td) {
					td = $(td)	;
					td.html(td.html().htmlentitiesdecode().trim())
				});
			});
		}
	}
});
