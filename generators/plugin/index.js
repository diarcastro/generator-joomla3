'use strict';
/*
 *  Created by Diego Castro <ing.diegocastro@gmail.com>
 */

var generators = require('yeoman-generator'),
  s = require('underscore.string'),
  fieldsPrompt = require('../includes/fields-prompt'),
  defaultDataPrompt = require('../includes/default-data-prompt'),
  updateChecker = require('../includes/update-checker'),
  writeFiles = require('../includes/write-files'),
  data = {},
  toExport = generators.Base.extend({
    constructor: function() {
      generators.Base.apply(this, arguments);
      this.s = s;
    },
    askForName: function() {
      updateChecker('Plugin Generator!');
    },
    askForProjectData: function() {
      return defaultDataPrompt.assignYo(this).prompting(function(answers) {
        data = answers;
        var currentDate = new Date();
        data.creationDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
        data.projectName = data.projectName.slugify();
      });
    },
    askForType:function(){
      var prompts = [];
      prompts.push({
        type: 'list',
        choices: getPluginsTypes(),
        required: true,
        name: 'type',
        message: 'Select the plugin type:',
        default: 'custom'
      });

      var done = this.async();
      return this.prompt(prompts, (function(answers) {
        data.type = answers.type;
        done();
      }));
    },
    askForCustomName:function(){
      if(data.type=='custom'){
        var prompts = [];
        prompts.push({
          type: 'text',
          required: true,
          name: 'customName',
          message: 'type the custom type name:',
          default: 'system',
          validate:function(input){

          }
        });

        var done = this.async();
        return this.prompt(prompts, (function(answers) {
          data.customName = answers.customName.slugify();
          done();
        }));
      }
    },
    askForFieldsNumber: function() {
      var prompts = [];
      prompts.push({
        type: 'number',
        name: 'fieldsNumber',
        required: true,
        message: 'Type fields\'s number:',
        default: '0',
        validate: function(input) {
          return !isNaN(input);
        }
      });

      var done = this.async();
      return this.prompt(prompts, (function(answers) {
        data.fieldsNumber = parseInt(answers.fieldsNumber);
        done();
      }));
    },
    askForFields: function() {
      data.fields=[];
      if (data.fieldsNumber) {
        return fieldsPrompt.assignYo(this).prompting(data.fieldsNumber,{
          required: false
        }, function(fields) {
          data.fields = fields;
        });
      }
    },
    writeData: function() {
      data.type=data.customName?data.customName:data.type;
      data.plugin=data.projectName;
      data.pluginName=data.destination='plg_'+data.type+'_'+data.projectName;
      data.projectName={projectName:data.pluginName, pluginName:data.plugin};
      data.files='plugin.structure';
      this.data = data;
      writeFiles.assignYo(this).write(data);
      this.fs.copyTpl(
        this.templatePath('types/'+data.type+'.php'),
        data.pluginName+'/'+data.plugin+'.php',
        this
      );
    }
  });

  function getPluginsTypes(){
    return [
      'system',
      'user',
      'custom',
      'authentication',
      'captcha',
      'contact',
      'content',
      'editors',
      'extensions',
      'finder',
      'install',
      'quickicon'
    ];
  }

module.exports = toExport;
