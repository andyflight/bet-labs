// src/graphql/schema.js
const { makeExecutableSchema } = require('@graphql-tools/schema');
const resolvers = require('./resolvers');

// Визначення типів за допомогою Schema Definition Language (SDL)
const typeDefs = `
  type Address {
    _id: ID!
    flat_number: String
    building_number: String!
    street: String!
    city: String!
    country: String!
  }

  type Owner {
    _id: ID!
    name: String!
    email: String!
  }

  type Listing {
    _id: ID!
    type: String!
    address: Address!
    rooms: Int!
    date: String!
    price: Float!
    owner: Owner!
  }

  type Query {
    addresses: [Address]
    address(id: ID!): Address
    owners: [Owner]
    owner(id: ID!): Owner
    listings(city: String, minPrice: Float, maxPrice: Float, rooms: Int, type: String): [Listing]
    listing(id: ID!): Listing
  }

  type Mutation {
    # Address mutations
    createAddress(flat_number: String, building_number: String!, street: String!, city: String!, country: String!): Address
    updateAddress(id: ID!, flat_number: String, building_number: String, street: String, city: String, country: String): Address
    deleteAddress(id: ID!): Address

    # Owner mutations
    createOwner(name: String!, email: String!): Owner
    updateOwner(id: ID!, name: String, email: String): Owner
    deleteOwner(id: ID!): Owner

    # Listing mutations
    createListing(type: String!, address: ID!, rooms: Int!, price: Float!, owner: ID!): Listing
    updateListing(id: ID!, type: String, address: ID, rooms: Int, price: Float, owner: ID): Listing
    deleteListing(id: ID!): Listing
  }
`;

// Створення виконуваної схеми з типів та резолверів
const schema = makeExecutableSchema({ typeDefs, resolvers });

module.exports = schema;