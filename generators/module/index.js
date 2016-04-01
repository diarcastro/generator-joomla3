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
      updateChecker('Module Generator!');
    },
    askForProjectData: function() {
      return defaultDataPrompt.assignYo(this).prompting(function(answers) {
        data = answers;
        var currentDate = new Date();
        data.creationDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
        data.projectName = s.replaceAll(s.slugify(data.projectName), '-', '_');
      });
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
      if (data.fieldsNumber) {
        return fieldsPrompt.assignYo(this).prompting(data.fieldsNumber,{
          required: false
        }, function(fields) {
          data.fields = fields;
        });
      }
    },
    writeData: function() {
      data.moduleName=data.destination='mod_'+data.projectName;
      data.files='module.structure';
      this.data = data;
      return writeFiles.assignYo(this).write(data);
    }
  });

module.exports = toExport;
