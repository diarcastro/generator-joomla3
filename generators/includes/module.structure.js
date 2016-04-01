module.exports = function get(projectName) {
  return {
    'en-GB.module.ini':'en-GB.mod_'+projectName+'.ini',
    'en-GB.module.sys.ini':'en-GB.mod_'+projectName+'.sys.ini',
    'es-ES.module.ini':'es-ES.mod_'+projectName+'.ini',
    'es-ES.module.sys.ini':'es-ES.mod_'+projectName+'.sys.ini',

    'helper.php':'',
    'module.php':'mod_'+projectName+'.php',
    'module.xml':'mod_'+projectName+'.xml',
    'tmpl/default.php':'',

  };
};
