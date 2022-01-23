import Cookies from "js-cookie";

const fav_cookie_name = 'jazz-strs-favs';
const separator = ';';

export class FavoritesCookie {
    static has(id) {
        const favorites = Cookies.get(fav_cookie_name).split(separator);
        const index = favorites.indexOf(id.toString());

        if (index > -1) {
            return true;
        }

        return false;
    }

    static getFavorites() {
        return Cookies.get(fav_cookie_name).split(separator)
    }

    static setFavorites(favorites) {
        Cookies.set(fav_cookie_name, favorites.join(separator));
    }
}