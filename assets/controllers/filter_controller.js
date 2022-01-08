import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    search() {
        const search = this.getSearchValue();
        let rows = this.getRows();

        for (let i = 0 ; i < rows.length ; i++) {
            const current = $(rows[i]);
            current.hide();

            if (current.attr('data-name').toLowerCase().includes(search)) {
                current.show();
            }
        }
    }

    getRows() {
        return $('.main-table tbody tr');
    }

    getSearchValue() {
        let search = $('.filters .search-form input').val();
        search = search.toLowerCase();

        return search;
    }

    showClearIcon(event) {
        const input = $(event.currentTarget);
        const clearIcon = input.parent().children('i');

        if (input.val() != '') {
            clearIcon.removeClass('visually-hidden');
        } else {
            clearIcon.addClass('visually-hidden');
        }
    }

    clearSearchText(event) {
        const clearIcon = $(event.currentTarget);
        const input = clearIcon.parent().children('input');

        input.val('');
        clearIcon.addClass('visually-hidden');
        this.search();
    }
}
