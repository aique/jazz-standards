import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';
import { StandardsTable } from "../services/standards_table";

export default class extends Controller {
    update(event) {
        const tab = $(event.currentTarget);

        if (tab.hasClass('active')) {
            return;
        }

        this.removeCurrentActiveTab(tab.closest('.main-tabs'));
        tab.addClass('active');

        let rows = StandardsTable.getRows();

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
            StandardsTable.showTableMessageAndHideFilters(StandardsTable.empty_favorites_message);
        }
    }

    clearFilters(rows) {
        StandardsTable.showAll(rows)
        StandardsTable.showMainTable();
    }
}
