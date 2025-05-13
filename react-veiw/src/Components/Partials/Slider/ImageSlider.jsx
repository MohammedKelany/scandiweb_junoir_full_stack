import React, { useState, useEffect } from "react";
import "./ImageSlider.css"; // Make sure to create this file

const ImageSlider = (props) => {
    const images = props.images;
    const currentIndex = props.index;
    const setCurrentIndex = props.setter;


    const nextSlide = () => {
        setCurrentIndex((prevIndex) => (prevIndex + 1) % images.length);
    };

    const prevSlide = () => {
        setCurrentIndex((prevIndex) =>
            prevIndex === 0 ? images.length - 1 : prevIndex - 1
        );
    };

    useEffect(() => {
        const interval = setInterval(nextSlide, 5000); // Change slide every 4s
        return () => clearInterval(interval);
    }, []);

    return (
        <div className="slider-container">
            <div
                className="slider-wrapper"
                style={{ transform: `translateX(-${currentIndex * 100}%)` }}
            >
                {images.map((src, idx) => (
                    <img className="slide" src={src} alt={`Slide ${idx + 1}`} key={idx} />
                ))}
            </div>

            <button className="nav-button left" onClick={prevSlide}>
                &#10094;
            </button>
            <button className="nav-button right" onClick={nextSlide}>
                &#10095;
            </button>

            <div className="dots">
                {images.map((_, index) => (
                    <span
                        key={index}
                        className={`dot ${currentIndex === index ? "active" : ""}`}
                        onClick={() => setCurrentIndex(index)}
                    ></span>
                ))}
            </div>
        </div>
    );
};

export default ImageSlider;