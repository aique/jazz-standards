import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';
import { TableService } from "../services/table_service";

export default class extends Controller {
    update(event) {
        const tab = $(event.currentTarget);

        if (tab.hasClass('active')) {
            return;
        }

        this.removeCurrentActiveTab(tab.closest('.main-tabs'));
        tab.addClass('active');

        let rows = $('.main-table tbody tr');

        if (tab.data('filter') === 'favorites') {
            this.filterByFavorites(rows);
        } else {
            this.clearFilters(rows);
        }
    }

    removeCurrentActiveTab(tabs) {
        tabs.find('.nav-link.active').removeClass('active');
    }

    filterByFavorites(rows) {
        let emptyFavorites = true;

        for (let i = 0 ; i < rows.length ; i++) {
            const current = $(rows[i]);
            current.hide();

            if (current.find('.favorite-action').hasClass('active')) {
                current.show();
                emptyFavorites = false;
            }
        }

        if (emptyFavorites) {
            TableService.showEmptyFavoritesMessage();
        }
    }

    clearFilters(rows) {
        for (let i = 0 ; i < rows.length ; i++) {
            const current = $(rows[i]);
            current.show();
        }

        TableService.showMainTable();
    }
}
