import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';
import { TableService } from "../services/table_service";

export default class extends Controller {
    search() {
        TableService.doSearch(
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
        TableService.doFilter(
            'data-range',
            $(event.currentTarget).children('option:selected').val()
        );
    }

    filterByGenre() {
        TableService.doSearch(
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
