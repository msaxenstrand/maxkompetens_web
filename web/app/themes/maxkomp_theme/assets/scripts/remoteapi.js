var RemoteApi = (function($) {
    var client = new $.RestClient('http://46.101.250.188:8000/api/');

    var register_user = function(email, password) {
        client.add('register');
        client.register.create({username:email, password:password}).done(function(data, textStatus, xhrObject){
            alert('I have data: ' + data);
        });
    };

    var get_profile = function() {
        client.add('me');
        client.me.read().done(function(data, textStatus, xhrObject){
            alert('I have data: ' + data);
        });
    };

    var get_languages = function() {
        client.add('language');
        client.language.read().done(function(data, textStatus, xhrObject){
            alert('I have data: ' + data);
        });

    };

    return {
        register_user: register_user,
        get_profile: get_profile,
        get_languages: get_languages
    };
})(jQuery);