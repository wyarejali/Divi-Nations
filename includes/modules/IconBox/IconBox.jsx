import React, { Component } from 'react';
import {
    renderIcon,
    renderIconStyle,
    setResponsiveCSS,
} from '../DiviNationsCore/DivinationsCore';

export class IconBox extends Component {
    static slug = 'dina_icon_box';

    static css(props) {
        const additionalCss = [];
        let iconStyle = [];

        // Render icon style
        iconStyle = renderIconStyle(
            props,
            'icon',
            '%%order_class%% .dina_icon_box-icon i.dina_icon'
        );

        const responsiveCss = setResponsiveCSS(props, [
            {
                selector: '%%order_class%% .dina_icon_box-icon',
                optionName: 'horizontal_align',
                property: 'text-align',
            },

            {
                selector: '%%order_class%% .dina_icon_box-icon i.dina_icon',
                optionName: 'icon_color',
                property: 'color',
            },
            {
                selector: '%%order_class%% .dina_icon_box-icon i.dina_icon',
                optionName: 'icon_bg',
                property: 'background',
            },
            {
                selector: '%%order_class%% .dina_icon_box-icon i.dina_icon',
                optionName: 'icon_size',
                property: 'font-size',
            },
            {
                selector: '%%order_class%% .dina_icon_box-icon i.dina_icon',
                optionName: 'icon_padding',
                property: 'padding',
            },
            {
                selector: '%%order_class%% .dina_icon_box-icon',
                optionName: 'icon_margin',
                property: 'margin',
            },
        ]);

        return additionalCss.concat(iconStyle).concat(responsiveCss);
    }

    render_title = () => {
        const title = this.props.title;

        if (title) {
            return <h2 className="dina_icon_box-title">{title}</h2>;
        }
    };

    render_subtitle = () => {
        const subtitle = this.props.subtitle;

        if (subtitle) {
            return <h4 className="dina_icon_box-subtitle">{subtitle}</h4>;
        }
    };

    render_description = (description) => {
        if (description) {
            if (this.props.dynamic.description.value) {
                return (
                    <div className="dina_icon_box-description">
                        {this.props.dynamic.description.render()}
                    </div>
                );
            } else {
                return (
                    <div
                        className="dina_icon_box-description"
                        dangerouslySetInnerHTML={{ __html: description }}
                    ></div>
                );
            }
        }
    };

    // Render front content with condition if front title, subtitle or description inserted
    renderContent = () => {
        if (
            this.render_title() ||
            this.render_subtitle() ||
            this.render_description(this.props.description)
        ) {
            return (
                <div className="dina_flip_card_content-wrapper">
                    {this.render_title()}
                    {this.render_subtitle()}
                    {this.render_description(this.props.description)}
                </div>
            );
        }
    };

    renderButton() {
        const props = this.props;
        const utils = window.ET_Builder.API.Utils;

        if (props.use_button === 'on') {
            const buttonUrl =
                typeof props.button_link !== 'undefined'
                    ? props.button_link
                    : '';

            const buttonIocn =
                typeof props.button_icon !== 'undefined'
                    ? utils.processFontIcon(props.button_icon)
                    : '6';

            const target = props.is_new_window === 'on' ? '_blank' : '';

            const customClass = {
                et_pb_button: true,
                et_pb_custom_button_icon: props.button_icon,
            };

            if (props.button_text === '' && props.button_url === '') {
                return;
            }

            return (
                <div className="dina_icon_box-btn-wrapper">
                    <a
                        className={`${utils.classnames(
                            customClass
                        )} dina_btn dina_icon_box-btn`}
                        href={buttonUrl}
                        target={target}
                        data-icon={buttonIocn}
                    >
                        {props.dynamic.button_text.render()}
                    </a>
                </div>
            );
        }
    }

    render() {
        return (
            <div class="dina_icon_box">
                <div class="dina_icon_box-wrapper">
                    <div class="dina_icon_box-icon">
                        <i class="dina_icon">{renderIcon(this.props.icon)}</i>
                    </div>
                    {this.renderContent()}
                    {this.renderButton()}
                </div>
            </div>
        );
    }
}

export default IconBox;
