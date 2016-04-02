module.exports = function get(projectName) {
  var pluginName=projectName;
  if(typeof projectName==='object'){
    pluginName=projectName.pluginName;
    projectName=projectName.projectName;
  }
  return {
    'fields/index.html'                     :'fields/index.html',
    'language/en-GB/en-GB.plugin.ini'       :'language/en-GB/en-GB.'+projectName+'.ini',
    'language/en-GB/en-GB.plugin.sys.ini'   :'language/en-GB/en-GB.'+projectName+'.sys.ini',
    'language/es-ES/es-ES.plugin.ini'       :'language/es-ES/es-ES.'+projectName+'.ini',
    'language/es-ES/es-ES.plugin.sys.ini'   :'language/es-ES/es-ES.'+projectName+'.sys.ini',
    'plugin.xml'                            :pluginName+'.xml'

  };
};
