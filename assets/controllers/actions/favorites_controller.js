import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';
import { StandardsTable } from "../../services/standards_table";
import {FavoritesCookie} from "../../services/favorites_cookie";

export default class extends Controller {
    initialize() {
        const element = $(this.element);
        const icon = element.find('.favorite-action');
        const currentStandardId = icon.data('standard-id');

        if (FavoritesCookie.has(currentStandardId)) {
            icon.addClass('active');
        }
    }

    toggle(event) {
        const icon = $(event.currentTarget);

        if (icon.hasClass('active')) {
            this.removeFromFavorites(icon);
        } else {
            this.addToFavorites(icon);
        }
    }

    removeFromFavorites(icon) {
        icon.removeClass('active')

        const currentStandardId = icon.data('standard-id');;
        const favorites = FavoritesCookie.getFavorites();
        const index = favorites.indexOf(currentStandardId.toString());

        if (index > -1) {
            favorites.splice(index, 1);
        }

        FavoritesCookie.setFavorites(favorites)

        if ($('.main-tabs .nav-link.active').data('filter') === 'favorites') {
            icon.closest('tr').hide();
        }

        if (StandardsTable.isEmpty()) {
            StandardsTable.showTableMessageAndHideFilters(StandardsTable.empty_favorites_message);
        }
    }

    addToFavorites(icon) {
        icon.addClass('active');

        const currentStandardId = icon.data('standard-id');
        const favorites = FavoritesCookie.getFavorites();

        favorites.push(currentStandardId);
        FavoritesCookie.setFavorites(favorites);
    }
}
