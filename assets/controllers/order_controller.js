import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';
import {StandardsTable} from "../services/standards_table";

let initialRows = [];

export default class extends Controller {
    order(event) {
        this.setInitialState();

        const filter = $(event.currentTarget);

        if (filter.hasClass('active')) {
            this.reset(filter);
            return;
        }

        const order = filter.attr('data-order');

        this.sortRows(order);
        this.setActive(filter);
    }

    setInitialState() {
        if (initialRows.length == 0) {
            initialRows = StandardsTable.getRows();
        }
    }

    reset(filter) {
        StandardsTable.setRows(initialRows);
        filter.removeClass('active');
    }

    sortRows(order) {
        let sorted = false;
        let rows = StandardsTable.getRows();

        while(!sorted) {
            sorted = true;

            for (let i = 0 ; i < rows.length - 1 ; i++) {
                const current = $(rows[i]);
                const next = $(rows[i + 1]);

                if (this.sortNeeded(order, current, next)) {
                    current.insertAfter(next);
                    rows = StandardsTable.getRows();
                    sorted = false;
                }
            }
        }
    }

    sortNeeded(order, current, next) {
        const currentTempo = this.getTempo(current);
        const nextTempo = this.getTempo(next);

        if (order == 'asc') {
            return currentTempo > nextTempo;
        }

        return currentTempo < nextTempo;
    }

    getTempo(row) {
        return parseInt(row.attr('data-tempo'));
    }

    setActive(filter) {
        $('.standards-table-order').removeClass('active');
        filter.addClass('active');
    }
}
