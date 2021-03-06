var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

tinymce.init({
	selector: 'textarea',
	plugins: 'responsivefilemanager print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
	imagetools_cors_hosts: ['picsum.photos'],
	menubar: 'file edit view insert format tools table help',
	toolbar: 'responsivefilemanager | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
	toolbar_sticky: true,
	autosave_ask_before_unload: true,
	autosave_interval: '30s',
	autosave_prefix: '{path}{query}-{id}-',
	autosave_restore_when_empty: false,
	autosave_retention: '2m',
	image_advtab: true,
	importcss_append: true,
	height: 600,
	image_caption: true,
	quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
	noneditable_noneditable_class: 'mceNonEditable',
	toolbar_mode: 'sliding',
	contextmenu: 'link image imagetools table',
	skin: useDarkMode ? 'oxide-dark' : 'oxide',
	content_css: ['css/content.css', 'css/all.min.css'],
	content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
	verify_html: false,
	entity_encoding: "raw",
	external_filemanager_path:"lib/filemanager/",
	external_plugins: { "filemanager" : "plugins/responsivefilemanager/plugin.min.js"}
});