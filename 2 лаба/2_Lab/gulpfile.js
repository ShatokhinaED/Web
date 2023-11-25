const gulp = require('gulp');
const browserSync = require('browser-sync').create();

// Задача для вывода сообщения
function messageTask(message) {
  return function (done) {
    console.log(message);
    done();
  };
}

// Задача для последовательного выполнения
gulp.task('sequential', gulp.series(
  messageTask('Выполнение первой задачи...'),
  messageTask('Выполнение второй задачи...')
));

// Задача для параллельного выполнения
gulp.task('parallel', gulp.parallel(
  messageTask('Параллельное выполнение - Задача 1'),
  messageTask('Параллельное выполнение - Задача 2')
));

// Задача для запуска сервера BrowserSync
gulp.task('browserSync', function () {
  browserSync.init({
    server: {
      baseDir: './dist' // Папка, из которой будут обслуживаться файлы
    },
  });

  // Отслеживание изменений в файлах и автоматическая перезагрузка
  gulp.watch(['*.html', 'styles/*.css']).on('change', browserSync.reload);
});

// Задача по умолчанию - запуск сервера BrowserSync
gulp.task('default', gulp.series('parallel', 'sequential', 'browserSync', function (done) {
  console.log('Главная задача завершена.');
  done();
}));
