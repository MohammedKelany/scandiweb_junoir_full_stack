import React from 'react';
import './not_found_page.css';

const NotFoundPage = () => {
    return (
        <div className="not-found-container">
            <div className="not-found-content">
                <h1 className="error-code">404</h1>
                <h2 className="error-title">Page Not Found</h2>
                <p className="error-message">
                    Oops! The page you're looking for seems to have vanished into thin air.
                </p>
                <div className="error-details">
                    <p>Don't worry, you can:</p>
                    <ul>
                        <li>Check the URL for typos</li>
                        <li>Go back to the previous page</li>
                        <li>Return to our homepage</li>
                    </ul>
                </div>
                <a href="/" className="home-button">
                    Return to Homepage
                </a>
            </div>
        </div>
    );
};

export default NotFoundPage; 