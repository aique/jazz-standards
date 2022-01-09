import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    search() {
        this.show('data-name', this.getSearchValue())
    }

    getSearchValue() {
        let search = $('.filters .search-form input').val();
        search = search.toLowerCase();

        return search;
    }

    filterByRange() {
        this.show(
            'data-range',
            $(event.currentTarget).children('option:selected').val()
        );
    }

    show(attrName, value) {
        let rows = $('.main-table tbody tr');

        for (let i = 0 ; i < rows.length ; i++) {
            const current = $(rows[i]);
            current.hide();

            if (current.attr(attrName).includes(value)) {
                current.show();
            }
        }
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
