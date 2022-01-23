import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';
import { StandardsTable } from "../services/standards_table";

export default class extends Controller {
    search() {
        const search = this.getSearchValue()

        if (search === '') {
            return;
        }

        StandardsTable.doSearch(
            'data-name', search
        );
    }

    getSearchValue() {
        let search = $('.filters .search-form input').val();
        search = search.toLowerCase();

        return search;
    }

    filterByRange() {
        StandardsTable.doFilter(
            'data-range',
            $(event.currentTarget).children('option:selected').val()
        );
    }

    filterByGenre() {
        StandardsTable.doSearch(
            'data-genres',
            $(event.currentTarget).children('option:selected').val()
        );
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
