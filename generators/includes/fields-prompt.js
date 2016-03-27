var extend = require('extend'),
  s = require('underscore.string'),
  yg=null,
  fieldsPrompt = {
    assignPrompt: function(yeomanGenerator) {
      yg = yeomanGenerator;
      return this;
    },
    prompting: function(fieldsNumber, options, callback) {
      if (!parseInt(fieldsNumber)){
        if(typeof callback==='function') callback([]);
        return false;
      }
      var prompts = [];
      options = extend({
        name: true,
        type: true,
        required: true,
        label: false,
        desc: false,
        filter: false
      }, options || {});

      for (var i = 0; i < fieldsNumber; i++) {
        if (options.name) {
          prompts.push({
            type: 'input',
            name: 'name' + i,
            required: true,
            message: 'Type a name for field ' + (i + 1) + ':',
            validate: function(input) {
              return input !== '';
            }
          });
        }
        if (options.type) {
          prompts.push({
            type: 'list',
            name: 'type' + i,
            required: true,
            choices: getParametersTypes(),
            message: 'Select the type for field ' + (i + 1) + ':'
          });
        }
        if (options.label) {
          prompts.push({
            type: 'input',
            name: 'label' + i,
            required: true,
            message: 'Type a label for field ' + (i + 1) + ':',
            validate: function(input) {
              return input !== '';
            }
          });
        }
        if (options.desc) {
          prompts.push({
            type: 'input',
            name: 'desc' + i,
            required: false,
            message: 'Type a description for field ' + (i + 1) + ':'
          });
        }
        if (options.required) {
          prompts.push({
            type: 'confirm',
            name: 'required' + i,
            required: true,
            message: 'The field ' + (i + 1) + ' is required?',
            default: true
          });
        }
        if (options.filter) {
          prompts.push({
            type: 'confirm',
            name: 'filter' + i,
            required: true,
            message: 'Include The field ' + (i + 1) + ' in filter.xml?',
            default: false
          });
        }

      }
      if (!prompts.length){
        if(typeof callback==='function') callback([]);
        return false;
      };
      var done = yg.async();
      return yg.prompt(prompts, (function(answers) {
        var fields = [];
        if (fieldsNumber) {
          for (var i = 0; i < fieldsNumber; i++) {
            var field = {};
            for (var j in options) {
              if (options[j] === true) {
                field[j] = (j == 'name' ? s.replaceAll(s.slugify(answers[j + i]), '-', '_') : answers[j + i]);
              }
            }
            fields.push(field);
          }
        }
        done();
        if(typeof callback==='function') callback(fields);
      }));
    }
  };

function getParametersTypes() {
  return [
      'text',
      'integer',
      'textarea',
      'editor',
      'hidden',
      'calendar',
      'category',
      'user',
      'radio',
      'password',
      'menu',
      'menuitem',
      'list',
      'language',
      'filelist',
      'imagelist'
    ];
}

module.exports = fieldsPrompt;
