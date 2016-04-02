'use strict';
/*
 *  Created by Diego Castro <ing.diegocastro@gmail.com>
 */

var yosay = require('yosay'),
  updateNotifier = require('update-notifier'),
  chalk = require('chalk'),
  s = require('underscore.string'),
  path = require('path');

var pkg = require(path.join('../../', '/package.json'));

var updateChecker = function(title) {
  console.log(yosay('Hello! Welcome to Joomla 3.5 generator by Diego Castro @diarcastro\n'+title));
  var message, notifier;
  notifier = updateNotifier({
    pkg: pkg,
    updateCheckInterval: 1000 * 60 * 60 * 24
  });
  message = [];
  if (notifier.update) {
    message.push('Update '+chalk.green.bold(notifier.update.latest)+' available!');
    message.push(chalk.gray(' (current: ' + notifier.update.current + ')'));
    message.push('\nTo update: ' + chalk.magenta('npm install -g yo ' + pkg.name));
    message.push('\n' + chalk.white.bold('Recommend updating ') + chalk.green.bold(pkg.name) + chalk.white.bold(' before continuing.'));
    console.log(yosay(message.join(' '),{
      maxLength:50
    }));
    return true;
  }
  return false;
};

String.prototype.uCase = function() {
  return this.toUpperCase();
};
String.prototype.lCase = function() {
  return this.toLowerCase();
};
String.prototype.slugify=function(){
  return s.replaceAll(s.slugify(this).lCase(),'-','_');
};
module.exports = updateChecker;
