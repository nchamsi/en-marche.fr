import React from 'react';
import PropTypes from 'prop-types';
import Tabs from '../Tabs/index';
import LatestIdeasPane from './LatestIdeasPane';

function LatestIdeas(props) {
    const { published = {}, pending = {} } = props.ideas;
    const panes = [
        {
            title: 'Propositions finalisées',
            component: (
                <LatestIdeasPane
                    link="/atelier-des-idees/consulter"
                    ideas={published.items}
                    isLoading={published.isLoading}
                />
            ),
        },
        {
            title: 'Propositions en cours d\'élaboration',
            component: (
                <LatestIdeasPane
                    link="/atelier-des-idees/contribuer"
                    ideas={pending.items}
                    isLoading={pending.isLoading}
                />
            ),
        },
    ];

    return (
        <article className="latest-ideas">
            <div className="l__wrapper">
                <h2 className="latest-ideas__title">Consultez les dernières propostions publiées par nos adhérents</h2>
                <Tabs panes={panes} />
            </div>
        </article>
    );
}

LatestIdeas.defaultProps = {
    ideas: {},
};

LatestIdeas.propTypes = {
    ideas: PropTypes.shape({
        published: PropTypes.shape({ isLoading: PropTypes.bool, items: PropTypes.array }),
        pending: PropTypes.shape({ isLoading: PropTypes.bool, items: PropTypes.array }),
    }),
};

export default LatestIdeas;
