import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    fav(event) {
        const icon = $(event.currentTarget);

        if (icon.hasClass('active')) {
            icon.removeClass('active')
        } else {
            icon.addClass('active');
        }
    }
}
