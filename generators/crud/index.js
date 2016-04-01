'use strict';
/*
 *  Created by Diego Castro <ing.diegocastro@gmail.com>
 */

var generators = require('yeoman-generator'),
  s = require('underscore.string'),
  path = require('path'),
  jlang = require('../includes/jlang'),
  fieldsPrompt=require('../includes/fields-prompt'),
  updateChecker=require('../includes/update-checker'),
  pluralize = require('pluralize'),
  data = {},
  adminEnv = 'admin',
  siteEnv = 'site';


var crud = generators.Base.extend({
  constructor: function() {
    generators.Base.apply(this, arguments);
    data.package = this.package = this.fs.readJSON(path.join(process.cwd(), './package.json')) || {};
    this.s = s;
    this.paramToPhp = function(param) {
      switch (param) {
        case 'integer':
        case 'menu':
        case 'menuitem':
          return 'integer';
        default:
          return 'string';
      }
    };
    /**
     * return the first string field
     */
    this.firstStringField = function() {
      if (data.fieldsNumber) {
        for (var i = 0; i < data.fields.length; i++) {
          if (data.fields[i].type == 'text') return data.fields[i].name;
        }
      }
      return 'name';
    };
    /**
     * Write submenu in component.xml and ComponentHelper.php if exists
     * @return {void}
     */
    this.witeSubmenuItem = function() {
      if (!data.addSubmenuItem) return false;
      var componentXML = './' + data.projectName + '.xml',
        content, index;
      if (this.fs.exists(componentXML)) {
        var submenu = '\t<menu link="index.php?option=' + data.componentName + '&amp;view=' + data.modelListName + '" view="' + data.modelListName + '" img="class:' + data.modelListName + '" alt="' + s.capitalize(data.projectName) + '/' + s.capitalize(data.modelListName) + '">' + data.componentName + '_' + data.modelListName + '</menu>\n\t\t';
        content = this.fs.read(componentXML);
        index = content.indexOf('</submenu>');
        if (index >= 0 && content.indexOf(s.capitalize(data.projectName) + '/' + s.capitalize(data.modelListName)) == -1) {
          content = s.insert(content, index, submenu);
          this.log.ok('Overwriting file', data.projectName + '.xml', ' !');
          this.fs.write(componentXML, content);
        }
      } else {
        this.log.error('File', componentXML, 'not found!');
      }
      var helper = data.baseDir + 'helpers/' + data.projectName + '.php';
      if (this.fs.exists(helper)) {
        var sm = [
          "JHtmlSidebar::addEntry(",
          "\t\t\tJText::_('" + data.componentName.uCase() + "_SUBMENU_" + data.modelListName.uCase() + "'),",
          "\t\t\t'index.php?option=" + data.componentName + "&view=" + data.modelListName + "',",
          "\t\t\t$vName == '" + data.modelListName + "'",
          "\t\t);\n\t\t"
        ].join('\n');
        content = this.fs.read(helper);
        index = content.indexOf('/*--EOS');
        if (index >= 0 && content.indexOf('view=' + data.modelListName) == -1) {
          content = s.insert(content, index, sm);
          this.log.ok('Overwriting file', 'helpers/' + data.projectName + '.php', ' !');
          this.fs.write(helper, content);
        }
      }
    };

  },
  askForProject: function() {
    updateChecker('Generate Component CRUD!');
    var prompts = [];
    if (!data.package.projectName) {
      prompts.push({
        type: 'text',
        name: 'projectName',
        required: true,
        message: 'Type the project Name. Without \'com_\' prefix',
        default: data.appname.replace('com_', '')
      });
    } else {
      data.projectName = data.package.projectName;
    }
    if (!data.package.projectEnv) {
      prompts.push({
        type: 'confirm',
        name: 'projectEnv',
        required: true,
        message: 'Generate CRUD for backend?',
        default: true
      });
    } else {
      data.projectEnv = data.package.projectEnv;
      data.baseDir = './';
    }

    prompts.push({
      type: 'confirm',
      name: 'modelItem',
      required: true,
      message: 'Generate ModelItem?',
      default: true
    });
    prompts.push({
      type: 'confirm',
      name: 'modelList',
      required: true,
      message: 'Generate ModelLis?',
      default: true
    });
    var done = this.async();
    return this.prompt(prompts, (function(answers) {
      for(var i in answers){
        data[i]=typeof answers[i]=='string'?(answers[i]?s.slugify(answers[i]):null):answers[i];
      }
      data.projectName=data.projectName.replace('-','_');
      data.componentName='com_'+data.projectName;
      if (answers.projectEnv === true) {
        data.projectEnv = adminEnv;
        data.baseDir = './admin/';
      } else if (answers.projectEnv === false) {
        data.projectEnv = siteEnv;
        data.baseDir = './site/';
      }
      done();
    }));
  },
  askFormModelItemName: function() {
    var prompts = [];
    prompts.push({
      type: 'input',
      name: 'modelItemName',
      required: true,
      message: 'Type the model Item Name(in singular):',
      //default:data.projectName,
      validate: function(input) {
        return input !== '';
      }
    });
    if (prompts.length) {
      var done = this.async();
      return this.prompt(prompts, (function(answers) {
        data.modelItemName = s.slugify(answers.modelItemName).replace('-','_').lCase();
        done();
      }));
    }
  },
  askFormModelListName: function() {
    if (data.modelList) {
      var prompts = [];
      prompts.push({
        type: 'input',
        name: 'modelListName',
        required: true,
        message: 'Type the model List Name(in plural):',
        default: data.modelItem ? pluralize(data.modelItemName) : '',
        validate: function(input) {
          return input !== '';
        }
      });
      if (prompts.length) {
        var done = this.async();
        return this.prompt(prompts, (function(answers) {
          data.modelListName = s.slugify(answers.modelListName).replace('-','_').lCase();
          done();
        }));
      }
    }
  },
  askForViewsName: function() {
    var prompts = [];
    if (data.modelItem) {
      prompts.push({
        type: 'input',
        name: 'viewItemName',
        required: true,
        message: 'Type the view Item name:',
        default: data.modelItemName,
        validate: function(input) {
          return input !== '';
        }
      });
    }
    if (data.modelList) {
      prompts.push({
        type: 'input',
        name: 'viewListName',
        required: true,
        message: 'Type the view list name:',
        default: data.modelListName,
        validate: function(input) {
          return input !== '';
        }
      });
      if(data.projectEnv==adminEnv){
        prompts.push({
          type: 'confirm',
          name: 'addSubmenuItem',
          required: true,
          message: 'Generate submenu Item:',
          default: true
        });
      }
    }

    if (data.projectEnv == adminEnv) {
      prompts.push({
        type: 'confirm',
        name: 'generateTable',
        required: true,
        message: 'Do you want to generate the '+s.capitalize(data.projectName)+'Table'+s.capitalize(data.modelItemName)+' class?',
        // message: 'Do you want to generate the '+s.capitalize(data.projectName)+'Table'+s.capitalize(data.modelItemName)+'(#__'+data.projectName+'_'+data.modelItemName+') class?',
        default: true
      });
    }
    if (data.modelItem) {
      prompts.push({
        type: 'confirm',
        name: 'generateForm',
        required: true,
        message: 'Do you want to generate the '+data.modelItemName+'.xml?',
        default: true
      });
    }
    if (data.modelList) {
      prompts.push({
        type: 'confirm',
        name: 'generateFilterSearch',
        required: true,
        message: 'Do you want to generate the filter_'+data.modelListName+'.xml?',
        default: true
      });
    }
    prompts.push({
      type: 'confirm',
      name: 'generateController',
      required: true,
      message: 'Do you want to generate the Controllers?',
      default: true
    });
    prompts.push({
      type: 'number',
      name: 'fieldsNumber',
      required: true,
      message: 'Type number of fields:',
      default: '0',
      validate: function(input) {
        return !isNaN(input);
      }
    });

    if (prompts.length) {
      var done = this.async();
      return this.prompt(prompts, (function(answers) {
        for(var i in answers){
          data[i]=typeof answers[i]=='string'?(answers[i]?s.slugify(answers[i]).replace('-','_').lCase():null):answers[i];
        }
        done();
      }));
    }
  },
  askForFields: function() {
    data.formFields={};
    data.fields=[];
    data.fieldsNumber = parseInt(data.fieldsNumber || 0);
    return fieldsPrompt.assignPrompt(this).prompting(data.fieldsNumber,{filter:data.generateFilterSearch},function(f){
      data.fields=f;
      for (var i in data.fields) {
        data.formFields[data.fields[i].name]=data.fields[i];
      }
    });
  },
  createNames: function() {
    data.names = {
      'item':{
        controller: s.capitalize(data.projectName) + 'Controller' + s.capitalize(data.modelItemName),
        model: s.capitalize(data.projectName) + 'Model' + s.capitalize(data.modelItemName),
        table: s.capitalize(data.projectName) + 'Table' + s.capitalize(data.modelItemName),
        view: s.capitalize(data.projectName) + 'View' + s.capitalize(data.viewItemName)
      },
      'list':{
        controller: s.capitalize(data.projectName) + 'Controller' + s.capitalize(data.modelListName),
        model: s.capitalize(data.projectName) + 'Model' + s.capitalize(data.modelListName),
        view: s.capitalize(data.projectName) + 'View' + s.capitalize(data.viewListName)
      },
    };
  },
  writing: function() {
    var filesToCopy = {};
    if (data.modelItem) {
      filesToCopy[this.templatePath('models/model.php')] = data.baseDir + 'models/' + data.modelItemName + '.php';
      if (data.generateForm) { //Create Form
        filesToCopy[this.templatePath('models/forms/form.xml')] = data.baseDir + 'models/forms/' + data.modelItemName + '.xml ';
      }
      if (data.generateController) { //Create JControllerForm
        filesToCopy[this.templatePath('controllers/controller.php')] = data.baseDir + 'controllers/' + data.modelItemName + '.php';
      }
      if (data.generateTable) { //Create JTable
        filesToCopy[this.templatePath('tables/table.php')] = data.baseDir + 'tables/' + data.modelItemName + '.php';
      }
    }
    if (data.modelList) {
      filesToCopy[this.templatePath('models/modellist.php')] = data.baseDir + 'models/' + data.modelListName + '.php';
      if (data.generateFilterSearch) { //Create Filter
        filesToCopy[this.templatePath('models/forms/filter.xml')] = data.baseDir + 'models/forms/filter_' + data.modelListName + '.xml';
      }
      if (data.generateController) { //Create JControllerList
        filesToCopy[this.templatePath('controllers/controllerlist.php')] = data.baseDir + 'controllers/' + data.modelListName + '.php';
      }
    }
    if (data.modelItem) {
      filesToCopy[this.templatePath('views/' + data.projectEnv + '/view/index.html')] = data.baseDir + 'views/' + data.modelItemName + '/index.html';
      filesToCopy[this.templatePath('views/' + data.projectEnv + '/view/index.html')] = data.baseDir + 'views/' + data.modelItemName + '/tmpl/index.html';
      filesToCopy[this.templatePath('views/' + data.projectEnv + '/view/view.html.php')] = data.baseDir + 'views/' + data.modelItemName + '/view.html.php';
      if (data.projectEnv == adminEnv) {
        filesToCopy[this.templatePath('views/' + data.projectEnv + '/view/tmpl/edit.php')] = data.baseDir + 'views/' + data.modelItemName + '/tmpl/edit.php';
      } else if (data.projectEnv == siteEnv) {
        //Create view site environment
        filesToCopy[this.templatePath('views/' + data.projectEnv + '/view/metadata.xml')] = data.baseDir + 'views/' + data.modelItemName + '/metadata.xml';
        filesToCopy[this.templatePath('views/' + data.projectEnv + '/view/tmpl/default.xml')] = data.baseDir + 'views/' + data.modelItemName + '/tmpl/default.xml';
        filesToCopy[this.templatePath('views/' + data.projectEnv + '/view/tmpl/default.php')] = data.baseDir + 'views/' + data.modelItemName + '/tmpl/default.php';
      }
    }
    if (data.modelList) {
      filesToCopy[this.templatePath('views/' + data.projectEnv + '/viewlist/index.html')] = data.baseDir + 'views/' + data.modelListName + '/index.html';
      filesToCopy[this.templatePath('views/' + data.projectEnv + '/viewlist/index.html')] = data.baseDir + 'views/' + data.modelListName + '/tmpl/index.html';
      filesToCopy[this.templatePath('views/' + data.projectEnv + '/viewlist/view.html.php')] = data.baseDir + 'views/' + data.modelListName + '/view.html.php';
      filesToCopy[this.templatePath('views/' + data.projectEnv + '/viewlist/tmpl/default.php')] = data.baseDir + 'views/' + data.modelListName + '/tmpl/default.php';
      if (data.projectEnv == adminEnv) {
        filesToCopy[this.templatePath('views/' + data.projectEnv + '/viewlist/tmpl/default_batch_body.php')] = data.baseDir + 'views/' + data.modelListName + '/tmpl/default_batch_body.php';
        filesToCopy[this.templatePath('views/' + data.projectEnv + '/viewlist/tmpl/default_batch_footer.php')] = data.baseDir + 'views/' + data.modelListName + '/tmpl/default_batch_footer.php';
      } else if (data.projectEnv == siteEnv) {

        filesToCopy[this.templatePath('views/' + data.projectEnv + '/viewlist/metadata.xml')] = data.baseDir + 'views/' + data.modelListName + '/metadata.xml';
        filesToCopy[this.templatePath('views/' + data.projectEnv + '/viewlist/tmpl/default.xml')] = data.baseDir + 'views/' + data.modelListName + '/tmpl/default.xml';
      }
    }
    this.data = data;
    for (var file in filesToCopy) {
      this.fs.copyTpl(
        this.templatePath(file),
        filesToCopy[file],
        this
      );
    }
    this._generateAdminLanguages();
  },
  _generateAdminLanguages: function() {
    jlang.setComponent(data.componentName);
    jlang.setEditorAndLog(this.fs, this.log);
    //Generate language const
    if(data.projectEnv==adminEnv){
      if (data.generateFilterSearch) {
        jlang.add('SEARCH_IN_TITLE', ['Search', 'Buscar']);
        jlang.add('LIST_LIMIT', ['Limit', 'Limite']);
        jlang.add('LIST_LIMIT_DESC', ['Limit', 'Limite']);
      }
      jlang.add(data.modelItemName+'_DETAILS', [data.modelItemName+' Details', 'Detalles de '+data.modelItemName]);
      jlang.add('MANAGER_' + data.modelItemName + '_NEW', [s.capitalize(data.projectName) + ': New ' + s.humanize(data.modelItemName), s.capitalize(data.projectName) + ': Nuevo ' + s.humanize(data.modelItemName)]);
      jlang.add('MANAGER_' + data.modelItemName + '_EDIT', [s.capitalize(data.projectName) + ': Edit ' + s.humanize(data.modelItemName), s.capitalize(data.projectName) + ': Editar ' + s.humanize(data.modelItemName)]);
      jlang.add('MANAGER_' + data.modelListName, s.capitalize(data.projectName) + ': ' + s.humanize(data.modelListName));
      jlang.add('JHELP_COMPONENTS_' + data.modelListName, s.humanize(data.modelListName), false);
      jlang.add('BATCH_OPTIONS' + data.modelListName, ['Bath proccess the selected ' + s.humanize(data.modelListName), 'Opciones por lote para los ' + s.humanize(data.modelListName) + ' seleccionados']);
      jlang.add(data.modelItemName + '_SAVE_SUCCESS', [s.humanize(data.modelItemName) + ' successfully saved.', s.humanize(data.modelItemName) + ' guardado correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_ARCHIVED', ['%d ' + s.humanize(data.modelListName) + ' successfully archived.', '%d ' + s.humanize(data.modelListName) + ' archivados correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_ARCHIVED_1', ['%d ' + s.humanize(data.modelItemName) + ' successfully archived.', '%d ' + s.humanize(data.modelItemName) + ' archivado correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_CHECKED_IN_0', ['No ' + s.humanize(data.modelItemName) + ' successfully checked in.', 'No se pudo desbloquear el ' + s.humanize(data.modelItemName) + ' correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_CHECKED_IN_1', ['%d ' + s.humanize(data.modelItemName) + ' successfully checked in.', '%d ' + s.humanize(data.modelItemName) + ' desbloqueado correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_CHECKED_IN_MORE', ['%d ' + s.humanize(data.modelListName) + ' successfully checked in.', '%d ' + s.humanize(data.modelListName) + ' desbloqueados correctamente.']);

      jlang.add(data.modelListName + '_N_ITEMS_DELETED', ['%d ' + s.humanize(data.modelListName) + ' successfully deleted.', '%d ' + s.humanize(data.modelListName) + ' borrados correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_DELETED_1', ['%d ' + s.humanize(data.modelItemName) + ' successfully deleted.', '%d ' + s.humanize(data.modelItemName) + ' borrado correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_PUBLISHED', ['%d ' + s.humanize(data.modelListName) + ' successfully published.', '%d ' + s.humanize(data.modelListName) + ' publicados correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_PUBLISHED_1', ['%d ' + s.humanize(data.modelItemName) + ' successfully published.', '%d ' + s.humanize(data.modelItemName) + ' publicado correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_UNPUBLISHED', ['%d ' + s.humanize(data.modelListName) + ' successfully unpublished.', '%d ' + s.humanize(data.modelListName) + ' despublicados correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_UNPUBLISHED_1', ['%d ' + s.humanize(data.modelItemName) + ' successfully unpublished.', '%d ' + s.humanize(data.modelItemName) + ' despublicado correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_TRASHED', ['%d ' + s.humanize(data.modelListName) + ' successfully trashed.', '%d ' + s.humanize(data.modelListName) + ' han sido movidos a la papelera correctamente.']);
      jlang.add(data.modelListName + '_N_ITEMS_TRASHED_1', ['%d ' + s.humanize(data.modelItemName) + ' successfully trashed.', '%d ' + s.humanize(data.modelItemName) + ' ha sido movido a la papelera correctamente.']);
      jlang.add(data.modelListName + '_NO_ITEM_SELECTED', ['No ' + s.humanize(data.modelListName) + ' selected.', 'Sin' + s.humanize(data.modelListName) + ' seleccionados.']);
      if (data.addSubmenuItem) {
        jlang.add('SUBMENU_' + data.modelListName, s.capitalize(s.humanize(data.modelListName)));
        jlang.addSys(data.modelListName, s.capitalize(s.humanize(data.modelListName)));
      }
    }
    for (var i in data.fields) {
      var field = data.fields[i];
      if (data.generateForm) {
        jlang.add('FIELD_' + field.name + '_LABEL', s.humanize(field.name));
        jlang.add('FIELD_' + field.name + '_DESC', s.humanize(field.name));
      }
      if (data.generateFilterSearch && data.projectEnv==adminEnv) {
        jlang.add('FILTER_' + field.name, ['- Select ' + s.humanize(field.name) + ' -', '- Seleccionar ' + s.humanize(field.name) + ' -']);
        jlang.add('FILTER_' + field.name + '_DESC', ['Filter by ' + s.humanize(field.name), 'Filtrar por ' + s.humanize(field.name)]);

        jlang.add('HEADING_' + field.name, s.humanize(field.name));
        jlang.add('HEADING_' + field.name + '_ASC', [s.humanize(field.name) + ' - ascending', s.humanize(field.name) + ' - ascendente']);
        jlang.add('HEADING_' + field.name + '_DESC', [s.humanize(field.name) + ' - descending', s.humanize(field.name) + ' - descendente']);
      }
    }
    jlang.writeFiles(data.baseDir);
    if(data.projectEnv==siteEnv){
      jlang.addSys(data.modelItemName+'_VIEW_DEFAULT_TITLE',s.humanize(data.modelItemName));
      jlang.addSys(data.modelItemName+'_VIEW_DEFAULT_OPTION',s.humanize(data.modelItemName));
      jlang.addSys(data.modelItemName+'_VIEW_DEFAULT_DESC',[s.humanize(data.modelItemName)+' description',s.humanize(data.modelItemName)+' descripción']);

      jlang.addSys(data.modelListName+'_VIEW_DEFAULT_TITLE',s.humanize(data.modelListName));
      jlang.addSys(data.modelListName+'_VIEW_DEFAULT_OPTION',s.humanize(data.modelListName));
      jlang.addSys(data.modelListName+'_VIEW_DEFAULT_DESC',[s.humanize(data.modelListName)+' description',s.humanize(data.modelListName)+' descripción']);

      jlang.writeFiles('./admin/');
    }
    this.witeSubmenuItem();
  }
});


module.exports = crud;
