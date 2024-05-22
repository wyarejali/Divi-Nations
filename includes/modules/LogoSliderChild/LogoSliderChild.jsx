import React, { Component } from 'react';

class LogoSliderChild extends Component {
    static slug = 'dina_logo_slider_child';

    render() {
        return (
            <img
                className="dina_logo_slider-item"
                src={this.props.image}
                alt={this.props.image_alt}
            />
        );
    }
}

export default LogoSliderChild;
