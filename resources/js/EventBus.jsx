import React from 'react';

export const EventBusContext = React.createContext();

export const EventBusProvider = ({ children }) => {
    const [events, setEvents] = React.useState({});

    const emit = (name, data) => {
        if(events[name]) {
            for(let cb of events[name]) {
                cb(data); // Call the callback
            }
        }
    };

    const on = (name, cb) => {
        if(!events[name]) {
            events[name] = [];
        }
        events[name].push(cb); // Add the callback to the array

        // Return a function that will remove the callback from the array to stop listening to the event
        return () => {
            events[name] = events[name].filter((callback) => callback !== cb);
        };
    };

    return (
        <EventBusContext.Provider value={{ emit, on }}>
            {children}
        </EventBusContext.Provider>
    );
};

export const useEventBus = () => {
    return React.useContext(EventBusContext);
};
