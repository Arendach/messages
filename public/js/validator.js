function validator(object) {

    /**
    * Сообщения по умолчанию
    */

    var requiredMessage = 'Данное поле должно быть заполненным!',
        numericMessage = 'Данное поле должно быть числовым!',
        minMessage = 'Минимальная длинна поля %s символов!',
        maxMessage = 'Максимальная длинна поля %s символов!',
        emailMessage = 'Данное поле должно быть корректным E-Mail адресом!',
        stringMessage = 'Данное поле должно быть строкой и состоять из символов русского или английского алфавита, дефиса или знака подчеркивания!',
        passwordMessage = 'Данное поле являеться паролем и должно состоять из символов русского или английского алфавита, дефиса или знака подчеркивания и длинной не менее 6 и не более 16-ти символов!',
        booleanMessage = 'Данные должны быть логического типа (true, false, undefined)',
        confirmationMessage = 'Поля должны совпадать!';

    /**
    * Паттерны валидации
    */

    var stringPattern = /^[\d\s\w]{1,}$/,
        numericPattern = /^[0-9]+$/,
        passwordPattern = /^[a-zA-Zа-яА-Я0-9-_]{6,16}$/,
        integerPattern = /^\-?[0-9]+$/,
        decimalPattern = /^\-?[0-9]*\.?[0-9]+$/,
        emailPattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
        alphaPattern = /^[a-z]+$/i,
        alphaNumericPattern = /^[a-z0-9]+$/i,
        alphaDashPattern = /^[a-z0-9_\-]+$/i,
        naturalPattern = /^[0-9]+$/i,
        naturalNoZeroPattern = /^[1-9][0-9]*$/i,
        ipPattern = /^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$/i,
        base64Pattern = /[^a-zA-Z0-9\/\+=]/i,
        numericDashPattern = /^[\d\-\s]+$/,
        urlPattern = /^((http|https):\/\/(\w+:{0,1}\w*@)?(\S+)|)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/,
        datePattern = /\d{4}-\d{1,2}-\d{1,2}/,
        minOrMaxPattern = /(min|max):([0-9]+)/g;


    function isEmpty (obj) { return Object.keys(obj).length === 0; };


    /**
     * Розбивка строки с правилам и на пункты
     */

    function splitRules(rules) {
        if(rules.search('/[|]/') != 0) {
            return rules.split('|');
        } else {
            return rules;
        }
    }

    /** 
     * @param {*Строка в которой делаем замену} string 
     * @param {*Новое значение} newValue 
     */

    function replaceMessage(string, newValue, pattern = '%s'){

        return string.replace(pattern, newValue);

    }

    /**
     * Функия записи сообщения для каллбека
     * @param defaultMessage
     * @param customMessage
     * @return {*}
     */

    function getMessage(defaultMessage, customMessage){
        if(customMessage == '' || customMessage === null || customMessage === undefined){
            return defaultMessage;
        } else {
            return customMessage;
        }
    }

    /**
     * 
     * @param {*Правило со сменным значением} rule 
     */
    function minOrMax(rule) {
            data = rule.split(':');
            return [data[0],data[1]];
    }

    /**
     * Функция обработки данных
     *
     * @return Обьект с ошибками
    */

    function validate(object) {

        /**
        * Данные для возвращения функцией
        */

        backData = {};

        for (var field in object) {

            /**
            * Все данные из обьекта
            */

            var obj = object[field];

            /**
             * Данные для валидации
             */

            var data = obj['data'];

            /**
            * Ячейка для возвращения
            */

            var group = backData[field] = {};

            group.message = false;

            /***
             * Правила валидации данных
             * */

            var rules = splitRules(obj['rules']);

            for(var rule in rules) {

                r = rules[rule];

                /**
                * Поле обязательное для заполнения
                */

                if (r == 'required') {
                    if(data == '' || data === null || data === undefined){
                        group.message = getMessage(requiredMessage, obj.message);
                    }
                }

                /**
                 * Цыфровое поле
                 */

                else if (r == 'numeric') {
                    if (data.search(numericPattern) != 0) {
                        group.message = getMessage(numericMessage, obj.message);
                    }
                }

                 /**
                  * Поле с минимальним или максимсальным значением
                 */

                else if (r.search(minOrMaxPattern) != -1) {
                    cb = minOrMax(r);

                    /**
                     * Проверка минимального значения
                     */

                    if (cb[0] == 'min') {                        
                        if (data.length < cb[1]) {
                            group.message = replaceMessage(getMessage(minMessage, obj.message), cb[1]);
                        }
                    } 
                    
                    /**
                     * Проверка максимального значения
                     */

                    else if (cb[0] == 'max') {
                        if (data.length > cb[1]) {
                            group.message = replaceMessage(getMessage(maxMessage, obj.message), cb[1]);
                        }
                    }
                }

                /**
                 * Поле для ввода Е-Мейла
                 */

                else if(r == 'email') {
                    if(data.search(emailPattern) == -1){
                        group.message = getMessage(emailMessage, obj.message);
                    }
                }

                /**
                * Тип проверки Строка
                */

                else if(r == 'string') {
                    if(data.search(stringPattern) == -1){
                        group.message = getMessage(stringMessage, obj.message);
                    }
                }
                
                /**
                 * Пароль
                 */

                else if(r == 'password') {
                    if(data.search(passwordPattern) == -1){
                        group.message = getMessage(passwordMessage, obj.message);
                    }
                }
                
                /**
                 * Тип boolean
                 */

                else if(r == 'boolean') {
                    if(data !== true || data !== false || data !== undefined){
                        group.message = getMessage(booleanMessage, obj.message);
                    }
                }

                /**
                 * Сравнение двух полей
                 */

                else if(r == 'confirmation') {
                    if(data != obj.confirmation){
                        group.message = getMessage(confirmationMessage, obj.message);
                        console.log(data + '  =>  ' + obj.confirmation);
                    }
                }
            }

            /**
             * Удаление пустой ячейки
             */
            
            if(group.message === false){ delete backData[field]; }
        }
        /**
         * @return Обьект ошибок или true в случае удачи
         */

        if(isEmpty(backData)){ return true; }else{ return backData; }

    }
    return validate(object);
}