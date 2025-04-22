const AddressService = require('../services/AddressService');
const OwnerService = require('../services/OwnerService');
const ListingService = require('../services/ListingService');

const resolvers = {
    Query: {
        addresses: async () => {
            return AddressService.getAll();
        },
        address: async (_, { id }) => {
            return AddressService.getById(id);
        },

        owners: async () => {
            return OwnerService.getAll();
        },
        owner: async (_, { id }) => {
            return OwnerService.getById(id);
        },

        listings: async (_, args) => {
            if (Object.keys(args).length === 0) {
                return ListingService.getAll();
            }

            const allListings = await ListingService.getAll();

            return allListings.filter(listing => {
                let match = true;

                if (args.city && listing.address.city !== args.city) {
                    match = false;
                }

                if (args.minPrice && listing.price < args.minPrice) {
                    match = false;
                }

                if (args.maxPrice && listing.price > args.maxPrice) {
                    match = false;
                }

                if (args.rooms && listing.rooms !== args.rooms) {
                    match = false;
                }

                if (args.type && listing.type !== args.type) {
                    match = false;
                }

                return match;
            });
        },

        listing: async (_, { id }) => {
            return ListingService.getById(id);
        }
    },

    Mutation: {
        createAddress: async (_, args) => {
            return AddressService.create(args);
        },
        updateAddress: async (_, { id, ...rest }) => {
            return AddressService.update(id, rest);
        },
        deleteAddress: async (_, { id }) => {
            return AddressService.delete(id);
        },

        createOwner: async (_, args) => {
            return OwnerService.create(args);
        },
        updateOwner: async (_, { id, ...rest }) => {
            return OwnerService.update(id, rest);
        },
        deleteOwner: async (_, { id }) => {
            return OwnerService.delete(id);
        },

        createListing: async (_, args) => {
            return ListingService.create(args);
        },
        updateListing: async (_, { id, ...rest }) => {
            return ListingService.update(id, rest);
        },
        deleteListing: async (_, { id }) => {
            return ListingService.delete(id);
        }
    },

    Listing: {
        address: async (parent) => {
            if (parent.address._id) return parent.address;
            return AddressService.getById(parent.address);
        },
        owner: async (parent) => {
            if (parent.owner._id) return parent.owner;
            return OwnerService.getById(parent.owner);
        }
    }
};

module.exports = resolvers;