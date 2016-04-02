module.exports = function get(projectName) {
  return {
    'language/en-GB/en-GB.module.ini'       :'language/en-GB/en-GB.mod_'+projectName+'.ini',
    'language/en-GB/en-GB.module.sys.ini'   :'language/en-GB/en-GB.mod_'+projectName+'.sys.ini',
    'language/es-ES/es-ES.module.ini'       :'language/es-ES/es-ES.mod_'+projectName+'.ini',
    'language/es-ES/es-ES.module.sys.ini'   :'language/es-ES/es-ES.mod_'+projectName+'.sys.ini',

    'helper.php'                      :'',
    'module.php'                      :'mod_'+projectName+'.php',
    'module.xml'                      :'mod_'+projectName+'.xml',
    'tmpl/default.php'                :'',

  };
};
