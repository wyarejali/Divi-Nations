import React, { Component } from 'react';
import { setResponsiveCSS } from '../DiviNationsCore/DivinationsCore';

export class IconList extends Component {
    static slug = 'dina_icon_list';

    static css(props) {
        const additionalCss = [];

        const responsiveCss = setResponsiveCSS(props, [
            {
                selector: '%%order_class%% .dina_icon_list-item-container',
                optionName: 'horizontal_align',
                property: 'justify-content',
            },
            {
                selector: '%%order_class%% .dina_icon_list-item-container',
                optionName: 'vertical_align',
                property: 'align-items',
            },
            {
                selector: '%%order_class%% .dina_icon_list-item-container',
                optionName: 'icon_gap',
                property: 'gap',
            },

            {
                selector: '%%order_class%% .dina_icon_list-icon i.dina_icon',
                optionName: 'icon_color',
                property: 'color',
            },
            {
                selector: '%%order_class%% .dina_icon_list-icon i.dina_icon',
                optionName: 'icon_bg',
                property: 'background',
            },
            {
                selector: '%%order_class%% .dina_icon_list-icon i.dina_icon',
                optionName: 'icon_size',
                property: 'font-size',
            },
            {
                selector: '%%order_class%% .dina_icon_list-icon i.dina_icon',
                optionName: 'icon_padding',
                property: 'padding',
            },
            {
                selector: '%%order_class%% .dina_icon_list-icon',
                optionName: 'icon_margin',
                property: 'margin',
            },

            {
                selector: '%%order_class%% .dina_icon_list_item',
                optionName: 'item_margin',
                property: 'margin',
                important: true,
            },
            {
                selector: '%%order_class%% .dina_icon_list_item',
                optionName: 'item_padding',
                property: 'padding',
                important: true,
            },
        ]);

        return additionalCss.concat(responsiveCss);
    }

    render() {
        return (
            <div className="dina_icon_list-container">
                <div className="dina_icon_list-items-wrapper">
                    {this.props.content}
                </div>
            </div>
        );
    }
}

export default IconList;
