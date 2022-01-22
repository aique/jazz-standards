import $ from 'jquery';
import Cookies from 'js-cookie'
import { Controller } from '@hotwired/stimulus';
import { TableService } from "../../services/table_service";

const fav_cookie_name = 'jazz-strs-favs';

export default class extends Controller {
    initialize() {
        const element = $(this.element);
        const icon = element.find('.favorite-action');
        const currentStandardId = icon.data('standard-id');
        const favorites = Cookies.get(fav_cookie_name).split(';');

        const index = favorites.indexOf(currentStandardId.toString());

        if (index > -1) {
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
        const currentStandardId = icon.data('standard-id');
        const prevCookieValue = Cookies.get(fav_cookie_name);

        icon.removeClass('active')
        const favorites = prevCookieValue.split(';');
        const index = favorites.indexOf(currentStandardId.toString());

        if (index > -1) {
            favorites.splice(index, 1);
        }

        Cookies.set(fav_cookie_name, favorites.join(';'));

        if ($('.main-tabs .nav-link.active').data('filter') === 'favorites') {
            icon.closest('tr').hide();
        }

        if (TableService.isEmpty()) {
            TableService.showEmptyFavoritesMessage();
        }
    }

    addToFavorites(icon) {
        const currentStandardId = icon.data('standard-id');
        const prevCookieValue = Cookies.get(fav_cookie_name);

        icon.addClass('active');

        let newValue = prevCookieValue + ';' + currentStandardId;

        if (prevCookieValue == undefined || prevCookieValue == '') {
            newValue = currentStandardId;
        }

        Cookies.set(fav_cookie_name, newValue);
    }
}
