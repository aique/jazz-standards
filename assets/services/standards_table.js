import $ from "jquery";

export class StandardsTable {
    static no_results_message = 'No results found';
    static empty_favorites_message = 'Your favorites list is empty';

    static getRows() {
        return $('.main-table tbody tr');
    }

    static setRows(rows) {
        $('.main-table tbody').html(rows);
    }

    static isEmpty() {
        let rows = StandardsTable.getRows();

        for (let i = 0 ; i < rows.length ; i++) {
            const current = $(rows[i]);

            if (current.css('display') !== 'none') {
                return false;
            }
        }

        return true;
    }

    static showMainTable() {
        $('.main-table').removeClass('visually-hidden');
        $('.filters').removeClass('visually-hidden');
        $('.table-message').addClass('visually-hidden');
    }

    static showTableMessage(message) {
        $('.main-table').addClass('visually-hidden');

        $('.table-message')
            .html(message)
            .removeClass('visually-hidden');
    }

    static showTableMessageAndHideFilters(message) {
        StandardsTable.showTableMessage(message);
        $('.filters').addClass('visually-hidden');
    }

    static doSearch(attrName, value) {
        let rows = StandardsTable.getRows();

        if (value === '') {
            StandardsTable.showAll(rows);
            return;
        }

        for (let i = 0 ; i < rows.length ; i++) {
            const current = $(rows[i]);
            current.hide();

            if (current.attr(attrName).includes(value)) {
                current.show();
            }
        }

        if (StandardsTable.isEmpty()) {
            StandardsTable.showTableMessage(StandardsTable.no_results_message);
        }
    }

    static doFilter(attrName, value) {
        let rows = StandardsTable.getRows();

        if (value === '') {
            StandardsTable.showAll(rows);
            return;
        }

        for (let i = 0 ; i < rows.length ; i++) {
            const current = $(rows[i]);
            current.hide();

            if (current.attr(attrName) === value) {
                current.show();
            }
        }

        if (StandardsTable.isEmpty()) {
            StandardsTable.showTableMessage(StandardsTable.no_results_message);
        }
    }

    static showAll(rows) {
        for (let i = 0 ; i < rows.length ; i++) {
            $(rows[i]).show();
        }

        StandardsTable.showMainTable();
    }
}