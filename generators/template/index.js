'use strict';
/*
 *  Created by Diego Castro <ing.diegocastro@gmail.com>
 */

var generators = require('yeoman-generator'),
  s = require('underscore.string'),
  fieldsPrompt = require('../includes/fields-prompt'),
  positionsPrompt = require('../includes/positions-prompt'),
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
      updateChecker('Template Generator!');
    },
    askForProjectData: function() {
      return defaultDataPrompt.assignYo(this).prompting(function(answers) {
        data = answers;
        var currentDate = new Date();
        data.creationDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
        data.projectName = s.replaceAll(s.slugify(data.projectName), '-', '_');
      });
    },

	askForPositionsNumber: function() {
      var prompts = [];
      prompts.push({
        type: 'number',
        name: 'positionsNumber',
        required: true,
        message: 'Type position\'s number:',
        default: '0',
        validate: function(input) {
          return !isNaN(input);
        }
      });
	    var done = this.async();
      return this.prompt(prompts, (function(answers) {
        data.positionsNumber = parseInt(answers.positionsNumber);
        done();
      }));
	 },
	askForPositions: function() {
      data.positions=[];
      if (data.positionsNumber) {
        return positionsPrompt.assignYo(this).prompting(data.positionsNumber,{
          required: false
        }, function(positions) {
          data.positions = positions;
        });
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
      data.templateName=data.destination=data.projectName;
      data.files='template.structure';
      this.data = data;
      return writeFiles.assignYo(this).write(data);
    }
  });

module.exports = toExport;
