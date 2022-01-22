import $ from "jquery";

export class TableService {
    static getRows() {
        return $('.main-table tbody tr');
    }

    static isEmpty() {
        let rows = TableService.getRows();

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
        $('.empty-favorites-message').addClass('visually-hidden');
    }

    static showEmptyFavoritesMessage() {
        $('.main-table').addClass('visually-hidden');
        $('.empty-favorites-message').removeClass('visually-hidden');
    }

    static doSearch(attrName, value) {
        let rows = TableService.getRows();

        if (value === '') {
            TableService.showAll(rows);
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

    static doFilter(attrName, value) {
        let rows = TableService.getRows();

        if (value === '') {
            TableService.showAll(rows);
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

    static showAll(rows) {
        for (let i = 0 ; i < rows.length ; i++) {
            $(rows[i]).show();
        }
    }
}