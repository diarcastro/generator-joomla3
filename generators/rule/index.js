'use strict';
/*
 *  Created by Diego Castro <ing.diegocastro@gmail.com>
 */

var generators = require('yeoman-generator'),
  s = require('underscore.string'),
  updateChecker = require('../includes/update-checker'),
  data={};


var toExport = generators.Base.extend({
  constructor: function() {
    generators.Base.apply(this, arguments);
    this.s = s;
  },
  checkForUpdates:function(){
    updateChecker('Rule Generator!');
  },
  askForProjectName:function(){
    var prompts=[
      {
        type:'text',
        name:'projectName',
        message:'Type the Rule name:',
        required:true
      },
      {
        type:'list',
        name:'projectType',
        choices:[
          'boolean',
          'color',
          'email',
          'equals',
          'number',
          'options',
          'tel',
          'url',
          'username'
        ],
        message:'Type select the rule type:',
        required:true
      },
    ];
    var done=this.async();
    return this.prompt(prompts, (function(answers) {
      data.projectName = s.classify(answers.projectName);
      data.projectType = answers.projectType;
      done();
    }));
  },
  writing:function(){
    this.data=data;
    this.fs.copyTpl(
      this.templatePath('rule.php'),
      data.projectName.lCase()+'.php',
      this
    );
  }
});

module.exports = toExport;
