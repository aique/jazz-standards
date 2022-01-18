import $ from 'jquery';
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    update(event) {
        const tab = $(event.currentTarget);

        if (tab.hasClass('active')) {
            return;
        }

        this.removeCurrentActiveTab(tab.closest('.main-tabs'));
        tab.addClass('active');
    }

    removeCurrentActiveTab(tabs) {
        tabs.find('.nav-link.active').removeClass('active');
    }
}
