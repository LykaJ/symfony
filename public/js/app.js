$(document).ready(function() {
    var $container = $('div#js-trick-media');
    var index = $container.find(':input').length;

    $('#js-add-media').click(function(e) {
        addMedia($container);

        e.preventDefault();
        return false;
    });

    if (index === 0) {
        addMedia($container);
    } else {
        $container.children('div').each(function() {
            addDeleteLink($(this));
        });
    }


    function addMedia($container) {
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Media n°' + (index+1))
            .replace(/__name__/g,        index)
        ;


        var $prototype = $(template);

        addDeleteLink($prototype);

        $container.append($prototype);

        index++;
    }

    function addDeleteLink($prototype) {
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');

        $prototype.append($deleteLink);
        $deleteLink.click(function(e) {
            $prototype.remove();

            e.preventDefault();
            return false;
        });
    }
});