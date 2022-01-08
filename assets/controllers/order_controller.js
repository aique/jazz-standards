import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';

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

    getRows() {
        return $('.main-table tbody tr');
    }

    setRows(rows) {
        $('.main-table tbody').html(rows);
    }

    setInitialState() {
        if (initialRows.length == 0) {
            initialRows = this.getRows();
        }
    }

    reset(filter) {
        this.setRows(initialRows);
        filter.removeClass('active');
    }

    sortRows(order) {
        let sorted = false;
        let rows = this.getRows();

        while(!sorted) {
            sorted = true;

            for (let i = 0 ; i < rows.length - 1 ; i++) {
                const current = $(rows[i]);
                const next = $(rows[i + 1]);

                if (this.sortNeeded(order, current, next)) {
                    current.insertAfter(next);
                    rows = this.getRows();
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
