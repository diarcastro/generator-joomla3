var componentName = null,
  s = require('underscore.string'),
  langs = {
    'en-GB': {
      'string': [],
      'sys': []
    },
    'es-ES': {
      'string': [],
      'sys': []
    }
  },
  jlang = {
    /**
     * Add lang translaction
     * @param  {string} name   Constant name
     * @param  {array|string} value  Value for connstant. If is array [0] for en-GB, [1] for es-ES
     * @param  {boolean} prefix Add component name as prefix
     * @return {void}
     */
    add: function(name, value, prefix) {
      this._add(name, value, prefix, 'string');
    },
    /**
     * Add lang translaction to system file
     * @param  {string} name   Constant name
     * @param  {array|string} value  Value for connstant. If is array [0] for en-GB, [1] for es-ES
     * @param  {boolean} prefix Add component name as prefix
     * @return {void}
     */
    addSys: function(name, value, prefix) {
      this._add(name, value, prefix, 'sys');
    },
    /**
     * Assign the component name
     * @param  {string} componentName Component name
     * @return {void}
     */
    setComponent: function(componentName) {
      this.componentName = componentName;
    },
    /**
     * Assign some var to use in this scope
     * @param  {Object} fs  mem-fs-editor
     * @param  {object} log Log functions
     * @return {void}
     */
    setEditorAndLog: function(fs, log) {
      this.fs = fs;
      this.log = log;
    },
    /**
     * Return the current component Name
     * @param  {boolean} upper Return in uppercase?
     * @return {string} Current component name
     */
    getComponent: function(upper) {
      upper = upper === false ? false : true;
      return upper ? this.componentName.toUpperCase() : this.componentName;
    },
    /**
     * Write jlang files
     * @param  {string} dir Files directory
     * @return {void}
     */
    writeFiles: function(dir) {
      var componentName = this.getComponent(false);
      for (var code in langs) {
        var file = dir + 'language/' + code + '/' + code + '.' + componentName + '.ini',
          fileSys = dir + 'language/' + code + '/' + code + '.' + componentName + '.sys.ini';
        this._writeLangFile(file, langs[code].string, code);
        this._writeLangFile(fileSys, langs[code].sys, code);
        langs[code].string=[];
        langs[code].sys=[];
      }
    },
    /**
     * Add lang translaction to system file
     * @param  {string} name   Constant name
     * @param  {array|string} value  Value for connstant. If is array [0] for en-GB, [1] for es-ES
     * @param  {boolean} prefix Add component name as prefix
     * @param  {string} subsection subsection in object langs
     * @return {void}
     */
    _add: function(name, value, prefix, subsection) {
      prefix = prefix === false ? false : true;
      langs['en-GB'][subsection].push((prefix ? this.getComponent() + '_' : '') + name.toUpperCase() + '=' + s.quote(typeof value == 'string' ? value : value[0]));
      langs['es-ES'][subsection].push((prefix ? this.getComponent() + '_' : '') + name.toUpperCase() + '=' + s.quote(typeof value == 'string' ? value : value[1] || value[0]));
    },
    /**
     * Write .ini file
     * @param  {string} file          File
     * @param  {string} constants     Content to write
     * @param  {string} langCode      Lang code
     * @return {void}
     */
    _writeLangFile: function(file, constants, langCode) {
      var componentName = this.getComponent(false),
        sys = (file.indexOf('.sys') !== -1 ? '.sys' : '');
      if (this.fs.exists(file)) {
        if (constants.length) {
          var content = this.fs.read(file);
          for (var i = 0; i < constants.length; i++) {
            if (content.indexOf(constants[i]) == -1) {
              content += '\n' + constants[i];
            }
          }
          this.fs.write(file, content);
          this.log.ok('Overwriting file', langCode + '.' + componentName + sys + '.ini', '!');
        }
      } else {
        if(constants.lenght){
          this.log('- - - - - Additional content for: ', langCode + '.' + componentName + sys + '.ini - - - - -');
          this.log(constants.join('\n'));
        }
      }

    }
  };

module.exports = jlang;
