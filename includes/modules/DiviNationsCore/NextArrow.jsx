import React, { Component } from 'react';
import { renderIcon } from './DivinationsCore';

class NextArrow extends Component {
    render() {
        const { className, style, onClick, icon } = this.props;

        return (
            <button
                className={`${className} dina_slider_icon dina_next_icon`}
                onClick={onClick}
                style={{ ...style, display: 'block' }}
            >
                <i className="dina_icon">{renderIcon(icon)}</i>
            </button>
        );
    }
}

export default NextArrow;
