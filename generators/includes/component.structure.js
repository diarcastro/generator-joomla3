module.exports = function get(projectName) {
  return {
    'admin':{
        //Admin Files
        'common/assets/css/styles.css':'admin/assets/css/styles.css',
        'common/assets/css/scss/_mixin.scss':'admin/assets/css/scss/_mixin.scss',
        'common/assets/css/scss/_styles.scss':'admin/assets/css/scss/_styles.scss',
        'common/assets/css/scss/_vars.scss':'admin/assets/css/scss/_vars.scss',
        'common/assets/css/scss/styles.scss':'admin/assets/css/scss/styles.scss',
        'admin/assets/css/fonts':'',
        'admin/assets/css/fonts/icons':'',
        'admin/assets/images':'',
        'common/assets/js/scripts.js':'admin/assets/js/scripts.js',

        'common/bower.json':'admin/bower.json',
        'common/composer.json':'admin/composer.json',
        'common/gulpfile.js':'admin/gulpfile.js',

        'admin/controllers':'',
        'admin/helpers/helper.php':'admin/helpers/'+projectName+'.php',
        'admin/helpers/html':'',
        'admin/includes':'',
        'admin/language/en-GB/en-GB.com_component.ini':'admin/language/en-GB/en-GB.com_'+projectName+'.ini',
        'admin/language/en-GB/en-GB.com_component.sys.ini':'admin/language/en-GB/en-GB.com_'+projectName+'.sys.ini',

        'admin/language/es-ES/es-ES.com_component.ini':'admin/language/es-ES/es-ES.com_'+projectName+'.ini',
        'admin/language/es-ES/es-ES.com_component.sys.ini':'admin/language/es-ES/es-ES.com_'+projectName+'.sys.ini',

        'admin/models/fields':'',
        'admin/models/forms':'',
        'admin/sql/install.mysql.utf8.sql':'',
        'admin/sql/uninstall.mysql.utf8.sql':'',
        'admin/sql/updates/mysql/1.0.sql':'',
        'admin/tables':'',
        'admin/views':'',
        'admin/access.xml':'',
        'admin/component.php':'admin/'+projectName+'.php',
        'admin/config.xml':'',
        'admin/controller.php':'',

        'admin/package.json':'',
        'index.html':'admin/index.html'
    },
    'site':{
        //Site Files
        'common/assets/css/styles.css':'site/assets/css/styles.css',
        'common/assets/css/scss/_mixin.scss':'site/assets/css/scss/_mixin.scss',
        'common/assets/css/scss/_styles.scss':'site/assets/css/scss/_styles.scss',
        'common/assets/css/scss/_vars.scss':'site/assets/css/scss/_vars.scss',
        'common/assets/css/scss/styles.scss':'site/assets/css/scss/styles.scss',
        'site/assets/css/fonts':'',
        'site/assets/css/fonts/icons':'',
        'site/assets/images':'',
        'common/assets/js/scripts.js':'site/assets/js/scripts.js',

        'site/controllers':'',
        'site/helpers':'',
        'site/includes':'',
        'site/language/en-GB/en-GB.com_component.ini':'site/language/en-GB/en-GB.com_'+projectName+'.ini',
        'site/language/es-ES/es-ES.com_component.ini':'site/language/es-ES/es-ES.com_'+projectName+'.ini',
        'site/models/fields':'',
        'site/models/forms':'',
        'site/views':'',
        'site/component.php':'site/'+projectName+'.php',
        'site/controller.php':'',
        'site/router.php':'',
        'site/package.json':'',

        'component.xml':projectName+'.xml',
        'package.json':'',
        'script.php':'',
        'index.html':'site/index.html',

        'common/bower.json':'site/bower.json',
        'common/composer.json':'site/composer.json',
        'common/gulpfile.js':'site/gulpfile.js'
    },
    'media':{
        //Media Files
        'media/css':'',
        'media/images':'',
        'media/js':''
    }
  };
};
