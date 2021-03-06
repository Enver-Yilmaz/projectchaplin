/**
 * This file is part of Project Chaplin.
 *
 * Project Chaplin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Project Chaplin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Project Chaplin. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package   Project Chaplin
 * @author    Kathie Dart
 * @copyright 2012-2017 Project Chaplin
 * @license   http://www.gnu.org/licenses/agpl-3.0.html GNU AGPL 3.0
 * @version   git
 * @link      https://github.com/kathiedart/projectchaplin
**/
import $ from 'jquery';

$(document).ready((ev) => {
    if (!window.location.href.startsWith('/user/youtube')) {
        return;
    }
    let pageToken = $('a[data-next-page-token]')
            .last()
            .data('next-page-token'),
        more = () => {
            if (pageToken) {
                $.ajax({
                    url: '?limit=50&pageToken='+pageToken,
                    success: function(data) {
                        $('.content-centre').append(data);
                        pageToken = $('a[data-next-page-token]')
                            .last()
                            .data('next-page-token');
                    }
                });
            }
        };

    $(window).on('scroll', (ev) => {
        if (window.innerHeight + document.documentElement.scrollTop <
            document.documentElement.scrollHeight) {
            return;
        }

        more();
    });
});
