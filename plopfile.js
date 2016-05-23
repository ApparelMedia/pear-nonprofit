module.exports = function (plop) {
    // create your generators here
    plop.setGenerator('components', {
        description: 'this is the components generator',
        prompts: [{
            type: 'input',
            name: 'name',
            message: 'What is the component name?',
            validate: function (value) {
                if ((/.+/).test(value)) { return true; }
                return 'name is required';
            }
        }],
        actions: [{
            type: 'add',
            path: 'resources/js/components/{{properCase name}}.jsx',
            templateFile: 'resources/templates/component.txt'
        }]
    });

    plop.setGenerator('reducers', {
        description: 'this is the reducers generator',
        prompts: [{
            type: 'input',
            name: 'name',
            message: 'What is the reducer name?',
            validate: function (value) {
                if ((/.+/).test(value)) { return true; }
                return 'name is required';
            }
        }],
        actions: [{
            type: 'add',
            path: 'resources/js/reducers/{{properCase name}}.jsx',
            templateFile: 'resources/templates/reducer.txt'
        }]
    });
};