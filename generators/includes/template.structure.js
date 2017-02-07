module.exports = function get(projectName) {
  return {
	'field/index.html'						:'field/index.html',
    'css/index.html'                     	:'css/index.html',
	'sass/index.html'						:'sass/index.html',
	'html/index.html'						:'html/index.html',
	'images/index.html'						:'images/index.html',
	'js/index.html'							:'js/index.html',
    'language/en-GB/en-GB.template.ini'       :'language/en-GB/en-GB.tpl_'+projectName+'.ini',
    'language/en-GB/en-GB.template.sys.ini'   :'language/en-GB/en-GB.tpl_'+projectName+'.sys.ini',
    'language/es-ES/es-ES.template.ini'       :'language/es-ES/es-ES.tpl_'+projectName+'.ini',
    'language/es-ES/es-ES.template.sys.ini'   :'language/es-ES/es-ES.tpl_'+projectName+'.sys.ini',
	'error.php' 							:'error.php',
	'index.php' 							:'index.php',
	'templateDetails.xml'					:'templateDetails.xml',
	'template_preview.png'					:'template_preview.png',
	'template_thumbnail.png'				:'template_thumbnail.png',
	'favicon.ico'							:'favicon.ico'
  };
};
