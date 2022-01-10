import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    search() {
        this.doSearch(
            'data-name',
            this.getSearchValue()
        );
    }

    getSearchValue() {
        let search = $('.filters .search-form input').val();
        search = search.toLowerCase();

        return search;
    }

    filterByRange() {
        this.doFilter(
            'data-range',
            $(event.currentTarget).children('option:selected').val()
        );
    }

    filterByGenre() {
        this.doSearch(
            'data-genres',
            $(event.currentTarget).children('option:selected').val()
        );
    }

    doSearch(attrName, value) {
        let rows = $('.main-table tbody tr');

        if (value === '') {
            this.showAll(rows);
            return;
        }

        for (let i = 0 ; i < rows.length ; i++) {
            const current = $(rows[i]);
            current.hide();

            if (current.attr(attrName).includes(value)) {
                current.show();
            }
        }
    }

    doFilter(attrName, value) {
        let rows = $('.main-table tbody tr');

        if (value === '') {
            this.showAll(rows);
            return;
        }

        for (let i = 0 ; i < rows.length ; i++) {
            const current = $(rows[i]);
            current.hide();

            if (current.attr(attrName) === value) {
                current.show();
            }
        }
    }

    showAll(rows) {
        for (let i = 0 ; i < rows.length ; i++) {
            $(rows[i]).show();
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
