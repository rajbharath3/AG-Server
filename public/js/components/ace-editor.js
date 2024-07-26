app.directive('aceEditor', function() {
    return {
        restrict: 'E',
        scope: {},
        templateUrl: '/js/components/ace-editor.html',
        link: function(scope, element) {
            var editor = ace.edit(element[0].querySelector("#editor"));
            editor.setTheme("ace/theme/monokai");
            editor.session.setMode("ace/mode/javascript");
            editor.setOptions({
                fontSize: '16px',
                borderRadius: '8px'
            });

            scope.selectedLanguage = 'javascript';

            scope.changeLanguage = function() {
                editor.session.setMode("ace/mode/" + scope.selectedLanguage);
            };

            scope.runCode = function() {
                var code = editor.getValue();
                var language = scope.selectedLanguage;
                runCode(code, language);
            };

            function runCode(code, language) {
                fetch('/api/run', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ code: code, language: language })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('output').textContent = data.output || data.error;
                })
                .catch(error => {
                    document.getElementById('output').textContent = '';
                    console.error('Error running code:', error);
                });
            }
        }
    };
});
