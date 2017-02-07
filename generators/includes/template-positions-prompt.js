var extend = require('extend'),
  s = require('underscore.string'),
  yg = null,
  defaultDataPrompt = {
    assignYo: function(yeomanGenerator) {
      yg = yeomanGenerator;
      return this;
    },
    prompting: function(options,callback) {
      if(typeof options=='function' && callback===undefined){
        callback=options;
        options={};
      }
      var prompts = [];
      options = extend({
        projectName: true,
        projectDescription: true,
        authorName: true,
        authorEmail: true,
        authorURL: true,
        license: true
      }, options || {});


      if (options.projectName) {
        prompts.push({
          type: 'text',
          name: 'projectName',
          message: 'Please type a project name(without joomla prefixes): ',
          default: s(s.slugify(yg.appname)).toLowerCase().value(),
          validate: function(input) {
            var success = input !== '' && !input.match(/^(com_|mod_|plg_)/);
            if (!success) {
              yg.log('\nThe project name can\'t init with sufix com_, mod_, plg_, etc.');
            }
            return success;
          }
        });
      }
      if (options.projectDescription) {
        prompts.push({
          type: 'text',
          name: 'projectDescription',
          message: 'Please type a project Description: ',
          default: 'No Description'
        });
      }
      if (options.authorName) {
        prompts.push({
            type: 'text',
            name: 'authorName',
            message: 'Please type the author name: ',
            default: 'Diego Castro'
        });
      }
      if (options.authorEmail) {
        prompts.push({
            type: 'text',
            name: 'authorEmail',
            message: 'Please type the author email: ',
            default: 'ing.diegocastro@gmail.com'
        });
      }
      if (options.authorURL) {
        prompts.push({
            type: 'text',
            name: 'authorURL',
            message: 'Please type the author url: ',
            default: ''
        });
      }
      if (options.license) {
        prompts.push({
            type: 'text',
            name: "license",
            message: "What's the copyright license?",
            default: "MIT"
        });
      }


      if (!prompts.length) {
        if (typeof callback === 'function') callback([]);
        return false;
      }
      var done = yg.async(), dataReturn={};
      return yg.prompt(prompts, (function(answers) {
        for (var i in options) {
          dataReturn[i]=answers[i];
        }
        done();
        if (typeof callback === 'function') callback(dataReturn);
      }));
    }
  };


module.exports = defaultDataPrompt;
