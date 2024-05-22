import React, { Component } from 'react';
import {
    renderIcon,
    renderIconStyle,
} from '../DiviNationsCore/DivinationsCore';

export class IconListChild extends Component {
    static slug = 'dina_icon_list_item';

    static css(props) {
        const additionalCss = [];
        const iconStyle = renderIconStyle(
            props,
            'icon',
            '%%order_class%% .dina_icon_list-icon i.dina_icon'
        );

        return additionalCss.concat(iconStyle);
    }

    renderTitle = () => {
        const heading = this.props.title;
        const Title = this.props.title_level ? this.props.title_level : 'h5';

        return <Title className="dina_icon_list-title">{heading}</Title>;
    };

    renderMCE = (description) => {
        if (description) {
            if (this.props.dynamic.description.value) {
                return (
                    <div className="dina_icon_list-description">
                        {this.props.dynamic.description.render()}
                    </div>
                );
            } else {
                return (
                    <div
                        className="dina_icon_list-description"
                        dangerouslySetInnerHTML={{ __html: description }}
                    ></div>
                );
            }
        }
    };

    render() {
        return (
            <div className="dina_icon_list-item-container">
                <div className="dina_icon_list-icon">
                    <i className="dina_icon">{renderIcon(this.props.icon)}</i>
                </div>
                <div className="dina_icon_list-content">
                    {this.renderTitle()}
                    {this.renderMCE(this.props.description)}
                </div>
            </div>
        );
    }
}

export default IconListChild;
