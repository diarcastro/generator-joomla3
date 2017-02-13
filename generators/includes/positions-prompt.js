var extend = require('extend'),
  s = require('underscore.string'),
  yg=null,
  positionsPrompt = {
    assignPrompt: function(yeomanGenerator) {
      yg = yeomanGenerator;
      return this;
    },
    assignYo: function(yeomanGenerator) {
      yg = yeomanGenerator;
      return this;
    },
    prompting: function(positionsNumber, options, callback) {
      if (!parseInt(positionsNumber)){
        if(typeof callback==='function') callback([]);
        return false;
      }
      var prompts = [];
      options = extend({
        name: true
      }, options || {});

      for (var i = 0; i < positionsNumber; i++) {
        if (options.name) {
          prompts.push({
            type: 'input',
            name: 'name' + i,
            required: true,
            message: 'Type a name for position ' + (i + 1) + ':',
            validate: function(input) {
              return input !== '';
            }
          });
        }
      }
      if (!prompts.length){
        if(typeof callback==='function') callback([]);
        return false;
      }
      var done = yg.async();
      return yg.prompt(prompts, (function(answers) {
        var positions = [];
        if (positionsNumber) {
          for (var i = 0; i < positionsNumber; i++) {
            var position = {};
            for (var j in options) {
              if (options[j] === true) {
                position[j] = (j == 'name' ? s.replaceAll(s.slugify(answers[j + i]), '-', '_') : answers[j + i]);
              }
            }
            positions.push(position);
          }
        }
        done();
        if(typeof callback==='function') callback(positions);
      }));
    }
  };

module.exports = positionsPrompt;
