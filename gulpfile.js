var elixr = require('laravel-elixir');
elixir.config.sourcemaps = false;

elixir(function(mix) {
	mix.styles(['styles.min.css', 'creative.css', 'style.css'], 'assets/css/main-v1.0.0.css');
	mix.scripts(['plugins.js', 'main.js'], 'assets/js/main-v1.0.0.js');
});