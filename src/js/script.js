$(document).ready(function () {
    $('.sort-link').each(function() {
        $(this).on("click", function (e) {
            let sortBy = $(this).attr('id').replace('sort_',''),
                url = new URL(window.location.href),
                urlSortBy = url.searchParams.get('sortBy'),
                urlSortType = url.searchParams.get('sortType'),
                sortType = 'asc';
            
            url.pathname = '/page';

            if (sortBy === urlSortBy) {
                sortType = urlSortType === 'asc' ? 'desc': 'asc';
            }
            url.searchParams.set('sortBy',sortBy);
            url.searchParams.set('sortType',sortType);
            $(this).attr('href',url.toString());
        })
    });

    $('input[type="checkbox"]').on('change',function() {
        let checked = $(this).prop('checked') ? 1 : 0;
        $('#complete-input').val(checked);
    });
});