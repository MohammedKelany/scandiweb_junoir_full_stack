import parse from 'html-react-parser';
import DOMPurify from 'dompurify';

const SafeHtmlParser = ({ htmlString }) => {
    const cleanHtml = DOMPurify.sanitize(htmlString);
    return <>{parse(cleanHtml)}</>;
};

export default SafeHtmlParser;
