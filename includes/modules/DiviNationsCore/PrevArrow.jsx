import React, { Component } from 'react';
import { renderIcon } from './DivinationsCore';

class PrevArrow extends Component {
    render() {
        const { className, style, onClick, icon } = this.props;

        return (
            <button
                className={`${className} dina_slider_icon dina_prev_icon`}
                onClick={onClick}
                style={{ ...style, display: 'block' }}
            >
                <i className="dina_icon">{renderIcon(icon)}</i>
            </button>
        );
    }
}

export default PrevArrow;
